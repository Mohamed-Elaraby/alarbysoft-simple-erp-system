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
        $totalClientsAccountsBalance = Client::sum('balance');
        return view('admin.clients.clients', compact('clients', 'totalClientsAccountsBalance'));
    }

    public function create()
    {
        return view('admin.clients.createClient');
    }

    public function store(Request $request)
    {
        $username = str_replace(' ','',$request->name);
        $usernameSplitToArray = str_split($username);
        $firstLetterFromArray = array_first($usernameSplitToArray);
        $lastLetterFromArray = array_last($usernameSplitToArray);
        $password = $firstLetterFromArray.$lastLetterFromArray."_".random_int(5000,1000000);
//        dd($password);

         $client = Client::create([
             'name' => $request->name,
             'password' => bcrypt($password),
             'password_text' => $password,
             'email' => $username."@".$username.".com",
             'client_type' => $request->client_type,
             'user_id' => Auth::user()->id,
         ]);

         /* Create Phone Number For The Client */

        $client->phone()->create([
            'number' => $request->phone,
        ]);

//        dd($password);

        return redirect()->route('admin.clients.index')->with('success', 'Client Added Successfully');
    }

    public function show($id)
    {
        $clientTransaction = Client::findOrFail($id);
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
        $client->update([
            'name' => $request->name,
            'balance' => $request->balance
        ]);
        $client->phone()->update([
            'number' => $request->phone
        ]);
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
