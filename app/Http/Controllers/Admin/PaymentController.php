<?php

namespace App\Http\Controllers\Admin;

use App\Client;
use App\Payment;
use App\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::all();
        return view('admin.payments.payments', compact('payments'));
    }

    public function create()
    {
        $clients = Client::all();
        return view('admin.payments.createPayment', compact( 'clients'));
    }

    public function store(Request $request)
    {
        Payment::create($request->all() + ['user_id' => Auth::user()->id]);
        return redirect()->route('admin.payments.index')->with('success', 'Payment Added Successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $payment = Payment::findOrFail($id);
        $clients = Client::all();
        return view('admin.payments.editPayment', compact('payment', 'clients'));
    }

    public function update(Request $request, $id)
    {
        Payment::findOrFail($id)->update($request->all());
        return redirect()->route('admin.payments.index')->with('success', 'Payment Edit Successfully');
    }

    public function destroy(Request $request)
    {
        if (isset($request->id)){
            $payment_id = $request->id;
            Payment::destroy($payment_id);
            return redirect()->route('admin.payments.index')->with('delete', 'Payment /s Delete Successfully');
        }else {
            return redirect()->back();
        }
    }
}
