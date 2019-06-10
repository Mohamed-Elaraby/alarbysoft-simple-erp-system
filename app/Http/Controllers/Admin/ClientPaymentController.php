<?php

namespace App\Http\Controllers\Admin;

use App\Client;
use App\ClientPayment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ClientPaymentController extends Controller
{
    public function index()
    {
        $payments = ClientPayment::all();
        return view('admin.payments.payments', compact('payments'));
    }

    public function create()
    {
        $clients = Client::all();
        return view('admin.payments.createPayment', compact( 'clients'));
    }

    public function store(Request $request)
    {
        $payment = ClientPayment::create($request->all() + ['user_id' => Auth::user()->id]);

        /* Record Transaction On Clint Transaction Table */

        $payment->clientTransaction()->create([
            'amount' => $request->amount,
            'transaction_date' => $request->payment_date,
            'user_id' => Auth::user()->id,
            'client_id' => $request->client_id,
        ]);
        return redirect()->route('admin.clientPayments.index')->with('success', 'Payment Added Successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $payment = ClientPayment::findOrFail($id);
        $clients = Client::all();
        return view('admin.payments.editPayment', compact('payment', 'clients'));
    }

    public function update(Request $request, $id)
    {
        ClientPayment::findOrFail($id)->update($request->all());
        return redirect()->route('admin.clientPayments.index')->with('success', 'Payment Edit Successfully');
    }

    public function destroy(Request $request)
    {
        if (isset($request->id)){
            $payment_id = $request->id;
            ClientPayment::destroy($payment_id);
            return redirect()->route('admin.clientPayments.index')->with('delete', 'Payment /s Delete Successfully');
        }else {
            return redirect()->back();
        }
    }
}
