<?php

namespace App\Http\Controllers\Admin;

use App\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::all();
        return view('admin.stores.stores', compact('stores'));
    }

    public function create()
    {
        return view('admin.stores.createStore');
    }

    public function store(Request $request, Store $store)
    {
        $store->name = $request->name;
        $store->address = $request->address;
        $store->phones = $request->phones;
        $store->user_id = Auth::user()->id;
        $store->save();
        return redirect()->route('admin.stores.index')->with('success', 'Store Added Successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $store = Store::findOrFail($id);
        return view('admin.stores.editStore', compact('store'));
    }

    public function update(Request $request, $id)
    {
        $store = Store::findOrFail($id);
        $store->name = $request->name;
        $store->address = $request->address;
        $store->phones = $request->phones;
        $store->user_id = Auth::user()->id;
        $store->save();
        return redirect()->route('admin.stores.index')->with('success', 'Store Edit Successfully');
    }

    public function destroy(Request $request)
    {
        if (isset($request->id)){
            $store_id = $request->id;
            Store::destroy($store_id);
            return redirect()->route('admin.stores.index')->with('delete', 'Store /s Delete Successfully');
        }else {
            return redirect()->back();
        }
    }
}
