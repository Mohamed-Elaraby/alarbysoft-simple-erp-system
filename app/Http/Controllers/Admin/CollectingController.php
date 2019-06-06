<?php

namespace App\Http\Controllers\Admin;

use App\Client;
use App\Collecting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CollectingController extends Controller
{
    public function index()
    {
        $collecting = Collecting::all();
        return view('admin.collecting.collecting', compact('collecting'));
    }

    public function create()
    {
        $clients = Client::all();
        return view('admin.collecting.createCollecting', compact( 'clients'));
    }

    public function store(Request $request)
    {
        Collecting::create($request->all() + ['user_id' => Auth::user()->id]);
        return redirect()->route('admin.collecting.index')->with('success', 'Collecting Added Successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $collect = Collecting::findOrFail($id);
        $clients = Client::all();
        return view('admin.collecting.editCollecting', compact('collect', 'clients'));
    }

    public function update(Request $request, $id)
    {
        Collecting::findOrFail($id)->update($request->all());
        return redirect()->route('admin.collecting.index')->with('success', 'Collecting Edit Successfully');
    }

    public function destroy(Request $request)
    {
        if (isset($request->id)){
            $collect_id = $request->id;
            Collecting::destroy($collect_id);
            return redirect()->route('admin.collecting.index')->with('delete', 'Collecting /s Delete Successfully');
        }else {
            return redirect()->back();
        }
    }
}
