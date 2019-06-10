<?php

namespace App\Http\Controllers\Admin;

use App\ClientTransaction;
use App\Product;
use App\PurchaseOrder;
use App\PurchaseOrderProducts;
use App\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        $all_purchase_orders = PurchaseOrder::all();
        return view('admin.purchases.purchases', compact('all_purchase_orders'));
    }

    public function create()
    {
        $products = Product::all();
        $suppliers = Supplier::all();
        return view('admin.purchases.createPurchases', compact('suppliers', 'products'));
    }

    public function store(Request $request, PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder = PurchaseOrder::create($request->all() + ['user_id' => Auth::user()->id]);
        $products_info = $request->data;
        foreach($products_info as $item){
            $purchaseOrder->purchaseOrderProducts()->create([
                'name' => $item['product_name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'total' => $item['total'],
            ]);

            $productExists = Product::where('name', $item['product_name'])->first();
            if ($productExists == true){
                $productExists->purchase_price = $item['price'];
                $productExists->quantity = $item['quantity'] + $productExists->quantity ;
                $productExists->save();
            }else{
                $purchaseOrder->products()->create([
                    'name' => $item['product_name'],
                    'purchase_price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'user_id' => Auth::user()->id,
                ]);
            }
        }


        /* Record Transaction On Supplier Transaction Table */

        $purchaseOrder->supplierTransactions()->create([
            'amount' => $request->invoice_total,
            'transaction_date' => $request->invoiceDate,
            'user_id' => Auth::user()->id,
            'supplier_id' => $request->supplier_id,
        ]);

        /* Update Supplier balance */

        $supplier = Supplier::findOrFail($request->supplier_id);
        if ($supplier->balance < 0) {
            // [ - ] DE
            $supplier->update(['balance' => ($supplier->balance - ($request->amount_due))]);// -100 - -150
        } else {
            // [ + ] CR
            $supplier->update(['balance' => ($supplier->balance + ($request->amount_due))]); // 50 + -50
        }

//        return redirect()->route('admin.purchases.index')->with('success', 'PurchasesOrder Added Successfully');
        return redirect()->back();
    }

    public function show($id)
    {
        $purchaseOrder = PurchaseOrder::where('id',$id)->first();
        return view('admin.purchases.detailsPurchasesInvoice', compact('purchaseOrder'));
    }

    public function edit($id)
    {
        $purchaseOrder = PurchaseOrder::findOrFail($id);
        $suppliers = Supplier::all();
        return view('admin.purchases.editPurchases', compact('purchaseOrder', 'suppliers'));
    }

    public function update(Request $request, $id)
    {
        /* Update Purchase Order */
        $purchaseOrder = PurchaseOrder::findOrFail($id)->update($request->all() + ['user_id' => Auth::user()->id]);
        /* Update Purchase Order Products */
        $products_info = $request->data;
        foreach($products_info as $item){
            $product = Product::where('name', $item['product_name'])->first();
            $purchaseOrderProducts = PurchaseOrderProducts::where(['purchase_order_id' => $id, 'id' => $item['product_id']])->get();
            /* Update Products Price On Products Table*/
            $product->purchase_price = $item['price'];

            foreach ($purchaseOrderProducts as $orderProduct){
                $current_quantity = $orderProduct->quantity; // 3
                $new_quantity = $item['quantity'];// 1
                $change_value = ($current_quantity - $new_quantity); // 2

                if ($current_quantity > $new_quantity){
                    $product->quantity = ($product->quantity - $change_value) ;
                }elseif($current_quantity < $new_quantity){
                    $product->quantity = ($product->quantity - $change_value) ;
                }
            }

            PurchaseOrderProducts::where(['purchase_order_id' => $id, 'id' => $item['product_id']])->update([
                'name' => $item['product_name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'total' => $item['total'],
            ]);
            $product->save();

        }
        return redirect()->route('admin.purchases.index')->with('success', 'Purchase Order Edit Successfully');
    }

    public function destroy(Request $request)
    {
        if (isset($request->id)){
            $purchases_id = $request->id;
            PurchaseInvoice::destroy($purchases_id);
            return redirect()->route('admin.purchases.index')->with('delete', 'Purchases Invoice /s Delete Successfully');
        }else {
            return redirect()->back();
        }
    }

    protected function fullOrder($id)
    {
        $purchasesOrder = PurchaseOrder::where('id', $id)->with('supplier')->first();
        return view('admin.purchases.fullOrder', compact('purchasesOrder'));
    }
}
