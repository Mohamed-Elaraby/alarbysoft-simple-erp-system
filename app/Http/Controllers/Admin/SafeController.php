<?php

namespace App\Http\Controllers\Admin;


use App\Safe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SafeController extends Controller
{
    public function index()
    {
        $theSafe = DB::table('saves')->select('final_amount')->orderBy('id', 'desc')->first();
//        dd($theSafe);
        return view('admin.safe.safe', compact('theSafe'));
    }

    public function operations()
    {
        return view('admin.safe.createNewProcess');
    }

    public function store(Request $request, Safe $safe)
    {
        $last_amount = Safe::all()->last();
        if ($request->processType == 0){
            $safe->amount_paid = $request->amount;
            $safe->final_amount = $last_amount->final_amount - $request->amount;
            $safe->comment = $request->comment;
            $safe->processType = $request->processType;
            $safe->user_id = Auth::user()->id;
            $safe->save();
            return redirect()->route('admin.safe.index')->with('warning', 'Amount withdrawn successfully');
        }else{
            $safe->amount_paid = $request->amount;
            $safe->final_amount = $last_amount->final_amount + $request->amount;
            $safe->comment = $request->comment;
            $safe->processType = $request->processType;
            $safe->user_id = Auth::user()->id;
            $safe->save();
            return redirect()->route('admin.safe.index')->with('success', 'The amount has been successfully deposited');
        }
    }
}
