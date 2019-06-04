<?php

namespace App\Http\Controllers\Admin;

use App\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        return view('admin.suppliers.suppliers', compact('suppliers'));
    }

    public function create()
    {
        return view('admin.suppliers.createSupplier');
    }

    public function store(Request $request, Supplier $supplier)
    {
        $supplier->name = $request->name;
        $supplier->address = $request->address;
        $supplier->phones = $request->phones;
        $supplier->user_id = Auth::user()->id;
        $supplier->save();
        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier Added Successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('admin.suppliers.editSupplier', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->name = $request->name;
        $supplier->address = $request->address;
        $supplier->phones = $request->phones;
        $supplier->user_id = Auth::user()->id;
        $supplier->save();
        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier Edit Successfully');
    }

    public function destroy(Request $request)
    {
        if (isset($request->id)){
            $supplier_id = $request->id;
            Supplier::destroy($supplier_id);
            return redirect()->route('admin.suppliers.index')->with('delete', 'Supplier /s Delete Successfully');
        }else {
            return redirect()->back();
        }
    }
}
