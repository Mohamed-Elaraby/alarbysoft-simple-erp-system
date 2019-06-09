<?php

namespace App\Http\Controllers\Admin;

use App\Supplier;
use App\SupplierPayment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SupplierPaymentController extends Controller
{
    public function index()
    {
        $supplierPayments = SupplierPayment::all();
        return view('admin.supplierPayments.supplierPayments', compact('supplierPayments'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        return view('admin.supplierPayments.createSupplierPayments', compact( 'suppliers'));
    }

    public function store(Request $request)
    {
        $supplierPayments = SupplierPayment::create($request->all() + ['user_id' => Auth::user()->id]);

        /* Record Transaction On Clint Transaction Table */

        $supplierPayments->supplierTransactions()->create([
            'amount' => $request->amount,
            'transaction_date' => $request->payment_date,
            'user_id' => Auth::user()->id,
            'supplier_id' => $request->supplier_id,
        ]);
        return redirect()->route('admin.supplierPayments.index')->with('success', 'Payment Added Successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $supplierPayment = SupplierPayment::findOrFail($id);
        $suppliers = Supplier::all();
        return view('admin.supplierPayments.editSupplierPayments', compact('supplierPayment', 'suppliers'));
    }

    public function update(Request $request, $id)
    {
        SupplierPayment::findOrFail($id)->update($request->all());
        return redirect()->route('admin.supplierPayments.index')->with('success', 'Payment Edit Successfully');
    }

    public function destroy(Request $request)
    {
        if (isset($request->id)){
            $payment_id = $request->id;
            SupplierPayment::destroy($payment_id);
            return redirect()->route('admin.supplierPayments.index')->with('delete', 'Payment /s Delete Successfully');
        }else {
            return redirect()->back();
        }
    }
}
