<?php

namespace App\Http\Controllers\Admin;

use App\Supplier;
use App\SupplierCollecting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SupplierCollectingController extends Controller
{
    public function index()
    {
        $supplierCollecting = SupplierCollecting::all();
        return view('admin.supplierCollecting.supplierCollecting', compact('supplierCollecting'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        return view('admin.supplierCollecting.createSupplierCollecting', compact( 'suppliers'));
    }

    public function store(Request $request)
    {
        $supplierCollecting = SupplierCollecting::create($request->all() + ['user_id' => Auth::user()->id]);

        /* Record Transaction On Clint Transaction Table */

        $supplierCollecting->supplierTransactions()->create([
            'amount' => $request->amount,
            'transaction_date' => $request->collecting_date,
            'user_id' => Auth::user()->id,
            'supplier_id' => $request->supplier_id,
        ]);

        /* Update Supplier balance */

        $supplier = Supplier::findOrFail($request->supplier_id);
        $supplier->update(['balance' => (($request->amount) + $supplier->balance)]);
        return redirect()->route('admin.supplierCollecting.index')->with('success', 'Payment Added Successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $supplierCollecting = SupplierCollecting::findOrFail($id);
        $suppliers = Supplier::all();
        return view('admin.supplierCollecting.editSupplierCollecting', compact('supplierCollecting', 'suppliers'));
    }

    public function update(Request $request, $id)
    {
        SupplierCollecting::findOrFail($id)->update($request->all());
        return redirect()->route('admin.supplierCollecting.index')->with('success', 'Payment Edit Successfully');
    }

    public function destroy(Request $request)
    {
        if (isset($request->id)){
            $payment_id = $request->id;
            SupplierCollecting::destroy($payment_id);
            return redirect()->route('admin.supplierCollecting.index')->with('delete', 'Payment /s Delete Successfully');
        }else {
            return redirect()->back();
        }
    }
}
