<?php

namespace App\Http\Controllers\Admin;

use App\Client;
use App\ClientTransaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return view('admin.clients.clients', compact('clients'));
    }

    public function create()
    {
        return view('admin.clients.createClient');
    }

    public function store(Request $request, Client $client)
    {
        $client->name = $request->name;
        $client->phones = $request->phones;
        $client->user_id = Auth::user()->id;
        $client->save();
        return redirect()->route('admin.clients.index')->with('success', 'Client Added Successfully');
    }

    public function show($id)
    {
        $clientTransaction = Client::findOrFail($id);
//        dd($clientTransaction);
        return view('admin.clients.detailsClientTransaction', compact('clientTransaction'));
    }

    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('admin.clients.editClient', compact('client'));
    }

    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);
        $client->name = $request->name;
        $client->balance = $request->balance;
        $client->phones = $request->phones;
        $client->user_id = Auth::user()->id;
        $client->save();
        return redirect()->route('admin.clients.index')->with('success', 'Client Edit Successfully');
    }

    public function destroy(Request $request)
    {
        if (isset($request->id)){
            $client_id = $request->id;
            Client::destroy($client_id);
            return redirect()->route('admin.clients.index')->with('delete', 'Client /s Delete Successfully');
        }else {
            return redirect()->back();
        }
    }
}
