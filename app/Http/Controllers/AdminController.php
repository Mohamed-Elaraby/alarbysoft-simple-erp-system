<?php

namespace App\Http\Controllers;

use App\Product;
use function foo\func;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','CheckRole:admin']);
    }

//    public function productsDataTable ()
//    {
//        $products = Product::all();
//        if ($products){
//            return DataTables::of($products)
//                ->addColumn('link', function ($product) {
//                    return ' <a href="/admin/product/'.$product->id.'/edit" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit </a>';
//
//                })
//                ->addColumn('action', function ($product) {
//                    return '<input type="checkbox" name="id[]" value="'.$product->id.'">';
//
//                })
//                ->rawColumns(['link', 'action'])
//                ->make(true);
//        }
//    }

    /* Admin Dashboard */
    public function dashboard ()
    {
        return view('admin.dashboard');
    }

    /* CURD Categories*/
    public function Categories ()
    {
        return "Admin Categories";
    }

    public function createCategory ()
    {
        //
    }

    public function storeCategory(Request $request)
    {
        //
    }

    public function editCategory($id)
    {
        //
    }

    public function updateCategory($id, Request $request)
    {
        //
    }

    public function destroyCategory()
    {
        //
    }

    /* CURD Products*/

    public function products ()
    {
        return view('admin.products');
    }

    public function createProduct ()
    {
        return view('admin.createProduct');
    }

    public function storeProduct(Request $request, Product $product)
    {
        $product->product = $request->product;
        $product->price = $request->price;
        $product->user_id = Auth::user()->id;
        $product->save();
        return redirect()->route('admin.products')->with('success', 'Product Added Successfully');
    }

    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.editProduct', compact('product'));
    }

    public function updateProduct($id, Request $request)
    {
        $product = Product::findOrFail($id);
        $product->product = $request->product;
        $product->price = $request->price;
//        $product->user_id = Auth::user()->id;
        $product->save();
        return redirect()->route('admin.products')->with('success', 'Product Edit Successfully');
    }

    public function destroyProduct(Request $request)
    {
        if (isset($request->id)){
            $product_id = $request->id;
            Product::destroy($product_id);
            return redirect()->route('admin.products')->with('delete', 'Product /s Delete Successfully');
        }else {
            return redirect()->back();
        }
    }

    /* CURD Users*/
    public function users ()
    {
        return "Admin Users";
    }

    public function createUser ()
    {
        //
    }

    public function storeUser(Request $request)
    {
        //
    }

    public function editUser($id, Request $request)
    {
        //
    }

    public function updateUser($id, Request $request)
    {
        //
    }

    public function destroyUser()
    {
        //
    }
}
