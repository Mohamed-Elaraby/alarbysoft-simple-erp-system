<?php

namespace App\Http\Controllers\Admin;

use App\Client;
use App\ClientTransaction;
use App\Product;
use App\Safe;
use App\SaleOrder;
use App\SaleOrderProducts;
use App\Serial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SaleOrderController extends Controller
{
    public function index()
    {
        $all_sales_orders = SaleOrder::all();
        return view('admin.sales.sales', compact('all_sales_orders'));
    }

    public function create()
    {
        $products = Product::all();
        $clients = Client::all();
        $invoiceNumber = DB::table('sale_orders')->select('invoiceNo')->orderBy('id', 'desc')->first();
        return view('admin.sales.createSale', compact('clients', 'products', 'invoiceNumber'));
    }

    public function store(Request $request, SaleOrder $saleOrder)
    {
        $saleOrder = SaleOrder::create($request->all() + ['user_id' => Auth::user()->id]);
        $saleOrderId = $saleOrder->id;
        $products_info = $request->data;
        foreach($products_info as $item){
//            If Dont Find Serial Key Set Push New Serial Index
            if (!array_key_exists('serial', $item)){
                $item['serial'] = NULL;
            }

            $saleOrder->saleOrderProducts()->create([
                'name' => $item['product_name'],
                'purchase_price' => $item['purchase_price'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'total' => $item['total'],
                'total_purchase_price' => ($item['purchase_price'] * $item['quantity']),
                'serial' => $item['serial'],
                'invoiceNo' => $request->invoiceNo,
            ]);

            $productExists = Product::where('name', $item['product_name'])->first();
            if ($productExists == true){
//                $productExists->purchase_price = $item['price'];
                $productExists->quantity = ($productExists->quantity - $item['quantity']) ;
                $productExists->save();
            }

            /* Update Serial Status To value [1] => [Sold] On Serials Table */
            $allSerials = Serial::all();
            foreach ($allSerials as $serial){
                if ($serial->serial == $item['serial']){
                    Serial::where('serial', $serial->serial)->update([
                        'status' => 1,
                    ]);
                }
            }
        }

        /* Record Transaction On Clint Transaction Table */

        $saleOrder->clientTransaction()->create([
            'amount' => $request->invoice_total,
            'transaction_date' => $request->invoiceDate,
            'user_id' => Auth::user()->id,
            'client_id' => $request->client_id,
        ]);

        /* Update Client balance */

        $client = Client::findOrFail($request->client_id);

        $client->update(['balance' => ($client->balance - ($request->amount_due))]);

        /* Update The Safe Amount */
        $last_amount = Safe::all()->last();
//        dd($last_amount);

        /* Update The Safe */
        $saleOrder->theSafe()->create([
            'amount_paid' => $request->amount_paid,
            'final_amount' => ($last_amount == null ? 0 : $last_amount->final_amount + ($request->amount_paid)),
            'user_id' => Auth::user()->id,
        ]);

        if ($request->has('invoice_btn')){
            return redirect()->back()->with('success', 'Sale Order Added Successfully');
        }elseif ($request->has('invoice_print_btn')){
            return redirect()->route('admin.sales.order', $saleOrderId);
        }
    }

    public function show($id)
    {
        $sale_orders = SaleOrder::where('id',$id)->with('saleOrderProducts')->first();
        return view('admin.sales.detailsSaleOrders', compact('sale_orders'));
    }

    public function edit($id)
    {
        $saleOrder = SaleOrder::findOrFail($id);
        $clients = Client::all();
        return view('admin.sales.editSale', compact('saleOrder', 'clients'));
    }

    public function update(Request $request, $id)
    {
//        dd($request->all());
        /* Update Sale Order */
        $saleOrder = SaleOrder::findOrFail($id)->update($request->all() + ['user_id' => Auth::user()->id]);

        /* Update Sale Order Products */
        $products_info = $request->data;

        foreach($products_info as $item){
            /* Update Products Quantity On Products Table*/
            $product = Product::where('name', $item['product_name'])->first();
            $saleOrderProducts = SaleOrderProducts::where(['sale_order_id' => $id, 'id' => $item['product_id']])->get();

            foreach ($saleOrderProducts as $orderProduct){
                $current_quantity = $orderProduct->quantity;
                $new_quantity = $item['quantity'];
                $change_value = ($current_quantity - $new_quantity);

                if ($current_quantity > $new_quantity){
                    $product->quantity = ($product->quantity + $change_value) ;
                }elseif($current_quantity < $new_quantity){
                    $product->quantity = ($product->quantity + $change_value) ;
                }
            }

            /* Update Products information On SaleOrderProducts Table*/
            SaleOrderProducts::where(['sale_order_id' => $id, 'id' => $item['product_id']])->update([
                'name' => $item['product_name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'total' => $item['total'],
            ]);
        }
        return redirect()->route('admin.sales.index')->with('success', 'Sales Order Edit Successfully');
    }

    public function destroy(Request $request)
    {
        if (isset($request->id)){
            if ($request->has('softDelete')){
                $sales_id = $request->id;
                SaleOrder::destroy($sales_id);
                return redirect()->route('admin.sales.index')->with('delete', 'Sale Invoice /s Delete Successfully');

            }elseif ($request->has('Recall')){

//                dd($request->all());
                $product_id = $request->id ; // sale order product table >> product_id
                $productSelected = SaleOrderProducts::where('id', $product_id)->first();
//                dd($product_id);
                /* Update Sale Order Product*/
                if ($productSelected->quantity < 2){
                    /* If Product Count Less than 2 Force Delete product from sale order product table */
                    SaleOrderProducts::where('id', $product_id)->forceDelete();
                }else{
                    /* If Product Count Larger than Or Equal 2 update price and Quantity from sale order product table */
                    $price = $productSelected->price;
                    $quantity = $productSelected->quantity - $request->quantity;
                    SaleOrderProducts::where('id', $product_id)->update([
                        'quantity' => $quantity,
                        'total' => $price * $quantity,
                    ]);
//                    dd($request->quantity);
                }

                /* Update Sale Orders */
                $sale_order_id = $productSelected->sale_order_id; // sale order product table >> sale_order_id
                $sO = SaleOrder::where('id', $sale_order_id)->first();
                if ($request->orderAmount != null){ // Update Sale Order Amount
//                    dd($productSelected);
                    $sub = $sO->invoice_subtotal - $request->orderAmount;
                    $tax = $sub * $sO->tax_percent/100;
                    $total = $sub + $tax;
                    $itemPercent = $request->orderAmount * $sO->tax_percent/100;
                    $paid = $sO->amount_paid - $request->orderAmount - $itemPercent;
//                    dd($total);
                    $sO->update([
                        'invoice_subtotal' => $sub,
                        'tax' => $tax,
                        'invoice_total' => $total,
                        'amount_paid' => $paid,
                        'amount_due' => $total - $paid,
                    ]);
                }

                /*  Update The Safe */
                if ($request->safeAmount != null){  // Update The Safe Amount
                    /* Update The Safe Amount */
                    $last_amount = Safe::all()->last();
                    //        dd($last_amount);
                    /* Update The Safe */
                    Safe::create([
                        'amount_paid' => $request->safeAmount,
                        'final_amount' => ($last_amount == null ? 0 : $last_amount->final_amount - ($request->safeAmount)),
                        'user_id' => Auth::user()->id,
                        'recall' => 1,
                    ]);
                }

//                /* Update product count On products table  */
                $onProductTable = Product::where('name', $productSelected->name)->first();
                $onProductTable->update([
                    'quantity' => $onProductTable->quantity + $request->quantity,
                ]);

                /* Update Transaction On Clint Transaction Table */
//dd($total);
                ClientTransaction::where('sale_order_id', $sale_order_id)->update([
                    'amount' => $total,
                ]);


                /* Update client balance  */
                $client_id = $sO->client_id;

                $client = Client::where('id', $client_id)->first();
                $client->update([
                    'balance' => $client->balance + $request->orderAmount,
                ]);
                /* Update Serial Status  */
                $productSerial = $productSelected->serial;
                Serial::where('serial', $productSerial)->update([
                    'status' => 0
                ]);

                /* Delete Sale Order If product count Less than 1 and delete client transaction  */
                $allSaleOrders = SaleOrder::all();
                foreach ($allSaleOrders as $saleOrder) {
                    if ($saleOrder->saleOrderProducts->count() < 1){
                        // check in all sale orders if no products related
                        //-> delete transaction from client transaction table
                        //-> delete order from sale order table
                        foreach ($saleOrder->clientTransaction as $clientTransaction) {
                            $clientTransaction->forceDelete();
                        }
                        $saleOrder->forceDelete();
                        return redirect()->route('admin.sales.index')->with('success', 'Product Recall Successfully');
                    }
                }
                return redirect()->back();

            }
        }else {
            return redirect()->back();
        }
    }

    public function fullOrder($id)
    {
        $salesOrder = SaleOrder::where('id', $id)->with('client')->first();
        $total_amount_products = $salesOrder->saleOrderProducts->sum('total');
        return view('admin.sales.fullOrder', compact('salesOrder', 'total_amount_products'));
    }


    public function getProductById(Request $request)
    {
        if ($request->ajax()){
            $item_id = $_GET['item_id'];
            $product = Product::where('id', $item_id)->first();
            $productSerials = $product->serials->where('status', 0);
            return response()->json(['product'=>$product, 'serials'=>$productSerials],200) ;
        }
    }

}
