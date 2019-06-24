<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\PurchaseOrder;
use App\PurchaseOrderProducts;
use App\Serial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SerialController extends Controller
{
    public function index()
    {
        $serials = Serial::all();
//        dd($theSafe);
        return view('admin.serials.serials', compact('serials'));
    }

    public function create()
    {
        $purchaseOrders = PurchaseOrder::orderBy('id', 'desc')->get();
        $products = Product::all();
        return view('admin.serials.createSerial', compact( 'purchaseOrders', 'products'));
    }

    public function store(Request $request)
    {
//        dd($request->all());
        $serials = $request->data;
        foreach($serials as $serial){
//            dd($request->purchase_order_id);
            Serial::create([
//                dd($request->all())
                "serial" => $serial['serial'],
                "status" => 0,
                "purchase_order_id" => $request->purchase_order_id,
                "product_id" => $request->product_id,
                "user_id" => Auth::user()->id,
            ]);
        }
//        return redirect()->route('admin.serials.index')->with('success', 'Serial /s Added Successfully');
        return redirect()->back()->with('success', 'Serial /s Added Successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $serial = Serial::findOrFail($id);
        $products = Product::all();
        return view('admin.serials.editSerial', compact('serial', 'products'));
    }

    public function update(Request $request, $id)
    {
        //        dd($request->all());
        Serial::findOrFail($id)->update($request->all());
        return redirect()->route('admin.serials.index')->with('success', 'Serial Edit Successfully');
    }

    public function destroy(Request $request)
    {
        if (isset($request->id)){
            $serial_id = $request->id;
            Serial::destroy($serial_id);
            return redirect()->route('admin.serials.index')->with('delete', 'Serial /s Delete Successfully');
        }else {
            return redirect()->back();
        }
    }
    public function getProductByOrderId(Request $request)
    {
        if ($request->ajax()){
            $order_id = $_GET['order_id'];
            $orderProducts = PurchaseOrderProducts::where('purchase_order_id', $order_id)->get();
            $products = Product::all();
            foreach ( $products as $product){

                $productP = [];
                foreach ($orderProducts as $OP){
                    if (in_array($OP->name,  $productP)){
                        continue ;
                    }

                    if ($product->name == $OP->name){
                        echo "<option value='".$product->id."'>".$product->name."</option>";

                    }

                    $productP [] = $OP->name;
                }

            }

        }
    }

}
