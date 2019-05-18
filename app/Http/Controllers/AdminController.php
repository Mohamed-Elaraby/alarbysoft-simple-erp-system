<?php

namespace App\Http\Controllers;

use App\Category;
use App\Client;
use App\Product;
use App\Store;
use App\Supplier;
use App\User;
use Illuminate\Http\Request;
use Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','CheckRole:admin']);
    }

    /* Admin Dashboard */
    public function dashboard ()
    {
        return view('admin.dashboard');
    }

    /* CURD Categories*/
    public function Categories ()
    {
        $categories = Category::orderBy('updated_at','desc')->paginate(5);
        $subCatsIds = Category::where('type','!=',0)->pluck('type')->toArray();
        $subCategories = Category::whereIn('id',$subCatsIds)->get();
//        dd($subCategories);
        return view('admin.categories.categories', compact('categories', 'subCategories'));
    }

    public function createCategory ()
    {
        $categories = Category::all();
        return view('admin.categories.createCategory', compact('categories'));
    }

    public function storeCategory(Category $category,Request $request)
    {
        $category->name = $request->name;
        $category->description = $request->description;
        $category->type = $request->parent;
        $category->user_id = Auth::user()->id;
        $category->save();
        return redirect()->route('admin.categories')->with('success', 'Category Added Successfully');
    }

    public function editCategory($id)
    {
        $category = Category::findOrFail($id);
        $allCategories = Category::all();
        return view('admin.categories.editCategory', compact('allCategories', 'category'));
    }

    public function updateCategory($id, Request $request)
    {
        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->description = $request->description;
        $category->type = $request->parent;
//        $category->user_id = Auth::user()->id;
        $category->save();
        return redirect()->route('admin.categories')->with('success', 'Category Edit Successfully');
    }

    public function destroyCategory(Request $request)
    {
        if (isset($request->id)){
            $category_id = $request->id;
            Category::destroy($category_id);
            return redirect()->route('admin.categories')->with('delete', 'Category /s Delete Successfully');
        }else {
            return redirect()->back();
        }
    }

    /* CURD Products*/

    public function products ()
    {
        $products = Product::orderBy('updated_at','desc')->paginate(5);
        return view('admin.products.products', compact('products'));
    }

    public function createProduct ()
    {
        $categories = Category::all();
        $stores = Store::all();
        $suppliers = Supplier::all();
        return view('admin.products.createProduct', compact('categories', 'stores', 'suppliers'));
    }

    public function storeProduct(Request $request, Product $product)
    {
        $product->name = $request->name;
        $product->purchasing_price = $request->purchasing_price;
        $product->dealer_price = $request->dealer_price;
        $product->selling_price = $request->selling_price;
        $product->quantity = $request->quantity;
        $product->serialNumber = $request->serialNumber;
        $product->user_id = Auth::user()->id;
        $product->category_id = $request->category;
        $product->store_id = $request->store;
        $product->supplier_id = $request->supplier;
        $product->save();
        return redirect()->route('admin.products')->with('success', 'Product Added Successfully');
    }

    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $stores = Store::all();
        $suppliers = Supplier::all();
        return view('admin.products.editProduct', compact('product','categories', 'stores', 'suppliers'));
    }

    public function updateProduct($id, Request $request)
    {
        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->purchasing_price = $request->purchasing_price;
        $product->dealer_price = $request->dealer_price;
        $product->selling_price = $request->selling_price;
        $product->quantity = $request->quantity;
        $product->serialNumber = $request->serialNumber;
        $product->user_id = Auth::user()->id;
        $product->category_id = $request->category;
        $product->store_id = $request->store;
        $product->supplier_id = $request->supplier;
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

    /* CURD Stores*/
    public function stores ()
    {
        $stores = Store::orderBy('updated_at','desc')->paginate(5);
        return view('admin.stores.stores', compact('stores'));
    }

    public function createStore ()
    {
        return view('admin.stores.createStore');
    }

    public function storeStore(Request $request, Store $store)
    {
        $store->name = $request->name;
        $store->address = $request->address;
        $store->phones = $request->phones;
        $store->user_id = Auth::user()->id;
        $store->save();
        return redirect()->route('admin.stores')->with('success', 'Store Added Successfully');
    }

    public function editStore($id)
    {
        $store = Store::findOrFail($id);
        return view('admin.stores.editStore', compact('store'));
    }

    public function updateStore($id, Request $request)
    {
        $store = Store::findOrFail($id);
        $store->name = $request->name;
        $store->address = $request->address;
        $store->phones = $request->phones;
        $store->user_id = Auth::user()->id;
        $store->save();
        return redirect()->route('admin.stores')->with('success', 'Store Edit Successfully');
    }

    public function destroyStore(Request $request)
    {
        if (isset($request->id)){
            $store_id = $request->id;
            Store::destroy($store_id);
            return redirect()->route('admin.stores')->with('delete', 'Store /s Delete Successfully');
        }else {
            return redirect()->back();
        }
    }

    /* CURD Suppliers*/
    public function suppliers ()
    {
        $suppliers = Supplier::orderBy('updated_at','desc')->paginate(5);
        return view('admin.suppliers.suppliers', compact('suppliers'));
    }

    public function createSupplier ()
    {
        return view('admin.suppliers.createSupplier');
    }

    public function storeSupplier(Request $request, Supplier $supplier)
    {
        $supplier->name = $request->name;
        $supplier->address = $request->address;
        $supplier->phones = $request->phones;
        $supplier->user_id = Auth::user()->id;
        $supplier->save();
        return redirect()->route('admin.suppliers')->with('success', 'Supplier Added Successfully');
    }

    public function editSupplier($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('admin.suppliers.editSupplier', compact('supplier'));
    }

    public function updateSupplier($id, Request $request)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->name = $request->name;
        $supplier->address = $request->address;
        $supplier->phones = $request->phones;
        $supplier->user_id = Auth::user()->id;
        $supplier->save();
        return redirect()->route('admin.suppliers')->with('success', 'Supplier Edit Successfully');
    }

    public function destroySupplier(Request $request)
    {
        if (isset($request->id)){
            $supplier_id = $request->id;
            Supplier::destroy($supplier_id);
            return redirect()->route('admin.suppliers')->with('delete', 'Supplier /s Delete Successfully');
        }else {
            return redirect()->back();
        }
    }

    /* CURD Clients*/
    public function clients ()
    {
        $clients = Client::orderBy('updated_at','desc')->paginate(5);
        return view('admin.clients.clients', compact('clients'));
    }

    public function createClient ()
    {
        return view('admin.clients.createClient');
    }

    public function storeClient(Request $request, Client $client)
    {
        $client->name = $request->name;
        $client->address = $request->address;
        $client->phones = $request->phones;
        $client->user_id = Auth::user()->id;
        $client->save();
        return redirect()->route('admin.clients')->with('success', 'Client Added Successfully');
    }

    public function editClient($id)
    {
        $client = Client::findOrFail($id);
        return view('admin.clients.editClient', compact('client'));
    }

    public function updateClient($id, Request $request)
    {
        $client = Client::findOrFail($id);
        $client->name = $request->name;
        $client->address = $request->address;
        $client->phones = $request->phones;
        $client->user_id = Auth::user()->id;
        $client->save();
        return redirect()->route('admin.clients')->with('success', 'Client Edit Successfully');
    }

    public function destroyClient(Request $request)
    {
        if (isset($request->id)){
            $client_id = $request->id;
            Client::destroy($client_id);
            return redirect()->route('admin.clients')->with('delete', 'Client /s Delete Successfully');
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

    public function storeUser(Request $request, User $user)
    {
        //
    }

    public function editUser($id)
    {
        //
    }

    public function updateUser($id, Request $request)
    {
        //
    }

    public function destroyUser(Request $request)
    {
        //
    }
}
