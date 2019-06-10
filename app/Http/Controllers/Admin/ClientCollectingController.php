<?php

namespace App\Http\Controllers\Admin;

use App\Client;
use App\ClientCollecting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ClientCollectingController extends Controller
{
    public function index()
    {
        $collecting = ClientCollecting::all();
        return view('admin.collecting.collecting', compact('collecting'));
    }

    public function create()
    {
        $clients = Client::all();
        return view('admin.collecting.createCollecting', compact( 'clients'));
    }

    public function store(Request $request)
    {
        $collecting = ClientCollecting::create($request->all() + ['user_id' => Auth::user()->id]);

        /* Record Transaction On Clint Transaction Table */

        $collecting->clientTransaction()->create([
            'amount' => $request->amount,
            'transaction_date' => $request->payment_date,
            'user_id' => Auth::user()->id,
            'client_id' => $request->client_id,
        ]);
        return redirect()->route('admin.clientCollecting.index')->with('success', 'Collecting Added Successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $collect = ClientCollecting::findOrFail($id);
        $clients = Client::all();
        return view('admin.collecting.editCollecting', compact('collect', 'clients'));
    }

    public function update(Request $request, $id)
    {
        ClientCollecting::findOrFail($id)->update($request->all());
        return redirect()->route('admin.clientCollecting.index')->with('success', 'Collecting Edit Successfully');
    }

    public function destroy(Request $request)
    {
        if (isset($request->id)){
            $collect_id = $request->id;
            ClientCollecting::destroy($collect_id);
            return redirect()->route('admin.clientCollecting.index')->with('delete', 'Collecting /s Delete Successfully');
        }else {
            return redirect()->back();
        }
    }
}
