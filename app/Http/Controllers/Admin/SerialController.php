<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\Serial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SerialController extends Controller
{
    public function index()
    {
        $serials = Serial::all();
//        dd($theSafe);
        return view('admin.serials.serials', compact('serials'));
    }

    public function create()
    {
        $products = Product::all();
        return view('admin.serials.createSerial', compact('products'));
    }

    public function store(Request $request)
    {
//        dd($request->all());
        $serials = $request->data;
        foreach($serials as $serial){
            Serial::create([
                'serial' => $serial['serial'],
                'product_id' => $request->product_id,
                'user_id' => Auth::user()->id,
            ]);
        }
        return redirect()->route('admin.serials.index')->with('success', 'Serial /s Added Successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $serial = Serial::findOrFail($id);
        $products = Product::all();
        return view('admin.serials.editSerial', compact('serial', 'products'));
    }

    public function update(Request $request, $id)
    {
        //        dd($request->all());
        Serial::findOrFail($id)->update($request->all());
        return redirect()->route('admin.serials.index')->with('success', 'Serial Edit Successfully');
    }

    public function destroy(Request $request)
    {
        if (isset($request->id)){
            $serial_id = $request->id;
            Serial::destroy($serial_id);
            return redirect()->route('admin.serials.index')->with('delete', 'Serial /s Delete Successfully');
        }else {
            return redirect()->back();
        }
    }
}
