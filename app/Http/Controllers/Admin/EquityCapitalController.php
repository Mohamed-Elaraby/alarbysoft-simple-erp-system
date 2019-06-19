<?php

namespace App\Http\Controllers\Admin;

use App\EquityCapital;
use App\Safe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EquityCapitalController extends Controller
{
    public function index()
    {
        $equityCapital = DB::table('equity_capitals')->select('final_amount')->orderBy('id', 'desc')->first();
//        dd($theSafe);
        return view('admin.equityCapital.equityCapital', compact('equityCapital'));
    }

    public function operations()
    {
        return view('admin.equityCapital.createNewProcess');
    }

    public function store(Request $request, EquityCapital $equityCapital, Safe $safe)
    {
        $last_amount = EquityCapital::all()->last();
        if ($request->processType == 0){
            if ($last_amount == null  || $last_amount->final_amount == 0){
                return redirect()->route('admin.equityCapital.index')->with('danger', 'Sorry no money can be withdrawn');
            }else{
                $equityCapital->amount_paid = $request->amount_paid;
                $equityCapital->final_amount = $last_amount->final_amount - $request->amount_paid;
                $equityCapital->comment = $request->comment;
                $equityCapital->processType = $request->processType;
                $equityCapital->user_id = Auth::user()->id;
                $equityCapital->save();
                return redirect()->route('admin.equityCapital.index')->with('warning', 'Amount withdrawn successfully');
            }
        }else{
            $equityCapital->amount_paid = $request->amount_paid;
            $equityCapital->final_amount = $last_amount == null ? $request->amount_paid : $last_amount->final_amount + $request->amount_paid;
            $equityCapital->comment = $request->comment;
            $equityCapital->processType = $request->processType;
            $equityCapital->user_id = Auth::user()->id;
            $equityCapital->save();

            /* Add Amount To The Safe Table */
            if ($request->has('action')){
                if ($request->action == 1){
                    $last_amount = Safe::all()->last();
                    $equityCapital->theSafe()->create([
                        'amount_paid' => $request->amount_paid,
                        'final_amount' => $last_amount == null ? $request->amount_paid : $last_amount->final_amount + $request->amount_paid,
                        'comment' => $request->comment,
                        'equity_capital_id' => $request->action,
                        'user_id' => Auth::user()->id,
                    ]);
                    return redirect()->route('admin.equityCapital.index')->with('success', 'The amount has been successfully deposited');
                }
            }
            return redirect()->route('admin.equityCapital.index')->with('success', 'The amount has been successfully deposited');
        }

    }
}
