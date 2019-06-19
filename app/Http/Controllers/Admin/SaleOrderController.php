<?php

namespace App\Http\Controllers\Admin;

use App\Client;
use App\Product;
use App\Safe;
use App\SaleOrder;
use App\SaleOrderProducts;
use App\Serial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
        return view('admin.sales.createSale', compact('clients', 'products'));
    }

    public function store(Request $request, SaleOrder $saleOrder)
    {
//        dd($request->all());
        $saleOrder = SaleOrder::create($request->all() + ['user_id' => Auth::user()->id]);
        $products_info = $request->data;
        foreach($products_info as $item){
            $saleOrder->saleOrderProducts()->create([
                'name' => $item['product_name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'total' => $item['total'],
            ]);

            $productExists = Product::where('name', $item['product_name'])->first();
            if ($productExists == true){
//                $productExists->purchase_price = $item['price'];
                $productExists->quantity = ($productExists->quantity - $item['quantity']) ;
                $productExists->save();
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
        if ($client->balance < 0) {
            // [ - ] DE
            $client->update(['balance' => ($client->balance - ($request->amount_due))]);//
        } else {
            // [ + ] CR
            $client->update(['balance' => ($client->balance - ($request->amount_due))]); //
        }

        /* Update The Safe Amount */
        $last_amount = Safe::all()->last();
//        dd($last_amount);

        $saleOrder->theSafe()->create([
            'amount_paid' => $request->amount_paid,
            'final_amount' => ($last_amount == null ? 0 : $last_amount->final_amount + ($request->amount_paid)),
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->back()->with('success', 'Sale Order Added Successfully');
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
//            dd($product);
            $saleOrderProducts = SaleOrderProducts::where(['sale_order_id' => $id, 'id' => $item['product_id']])->get();

            foreach ($saleOrderProducts as $orderProduct){
                $current_quantity = $orderProduct->quantity; //7
                $new_quantity = $item['quantity'];//9
                $change_value = ($current_quantity - $new_quantity); //-2

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
//            $product->save();
        }
        return redirect()->route('admin.sales.index')->with('success', 'Purchase Invoice Edit Successfully');
    }

    public function destroy(Request $request)
    {
        if (isset($request->id)){
            $sales_id = $request->id;
            SaleOrder::destroy($sales_id);
            return redirect()->route('admin.sales.index')->with('delete', 'Sale Invoice /s Delete Successfully');
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

    public function getSerials()
    {
        //
    }

    public function getProductById(Request $request)
    {
        if ($request->ajax()){
            $item_id = $_GET['item_id'];
            $product = Product::where('id', $item_id)->first();
            $productSerials = $product->serials;
            return response()->json(['product'=>$product, 'serials'=>$productSerials],200) ;
        }
    }

}
