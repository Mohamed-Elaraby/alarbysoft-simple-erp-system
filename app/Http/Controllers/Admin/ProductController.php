<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Product;
use App\Store;
use App\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::orderBy('updated_at','desc')->get();
        return view('admin.products.products',compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $stores = Store::all();
        $suppliers = Supplier::all();
        return view('admin.products.createProduct', compact('categories', 'stores', 'suppliers'));
    }

    public function store(Request $request,  Product $product)
    {
        $product->name = $request->name;
        $product->purchase_price = $request->purchase_price;
        $product->dealer_price = $request->dealer_price;
        $product->selling_price = $request->selling_price;
        $product->quantity = $request->quantity;
        $product->user_id = Auth::user()->id;
        $product->category_id = $request->category;
        $product->store_id = $request->store;
        $product->supplier_id = $request->supplier;
        $product->save();
        return redirect()->route('admin.products.index')->with('success', 'Product Added Successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $stores = Store::all();
        $suppliers = Supplier::all();
        return view('admin.products.editProduct', compact('product','categories', 'stores', 'suppliers'));
    }

    public function update(Request $request, $id)
    {
//        dd($request->all());
        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->purchase_price = $request->purchase_price;
        $product->dealer_price = $request->dealer_price;
        $product->selling_price = $request->selling_price;
        $product->quantity = $request->quantity;

        $product->category_id = $request->category;
        $product->store_id = $request->store;
        $product->supplier_id = $request->supplier;
        $product->save();
        return redirect()->route('admin.products.index')->with('success', 'Product Edit Successfully');
    }


    public function destroy(Request $request)
    {
        if (isset($request->id)){
            $product_id = $request->id;
            Product::destroy($product_id);
            return redirect()->route('admin.products.index')->with('delete', 'Product /s Delete Successfully');
        }else {
            return redirect()->back();
        }
    }
}
