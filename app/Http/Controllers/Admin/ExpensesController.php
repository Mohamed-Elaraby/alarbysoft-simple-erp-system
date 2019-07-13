<?php

namespace App\Http\Controllers\Admin;

use App\Expenses;
use App\ExpensesType;
use App\Safe;
use App\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ExpensesController extends Controller
{
    public function index()
    {
        $expenses = Expenses::all();
        return view('admin.expenses.expenses', compact('expenses'));
    }

    public function create()
    {
        $expensesType = ExpensesType::all();
        $stores = Store::all();
        return view('admin.expenses.createExpenses', compact('expensesType', 'stores'));
    }

    public function store(Request $request)
    {
//        dd($request->all());
        $expenses = Expenses::create($request->all() + ['user_id' => Auth::user()->id]);
        /* Update The Safe Amount */
        $last_amount = Safe::all()->last();
//        dd($last_amount);

        /* Update The Safe */
        $expenses->theSafe()->create([
            'amount_paid' => $request->amount,
            'final_amount' => ($last_amount == null ? 0 : $last_amount->final_amount - ($request->amount)),
            'user_id' => Auth::user()->id,
        ]);
        return redirect()->route('admin.expenses.index')->with('success', 'Expenses Added Successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $expense = Expenses::findOrFail($id);
        $expensesType = ExpensesType::all();
        $stores = Store::all();
        return view('admin.expenses.editExpenses', compact('expense', 'expensesType', 'stores'));
    }

    public function update(Request $request, $id)
    {
        //        dd($request->all());
        Expenses::findOrFail($id)->update($request->all());
        return redirect()->route('admin.expenses.index')->with('success', 'Expenses Edit Successfully');
    }

    public function destroy(Request $request)
    {
        if (isset($request->id)){
            $expense_id = $request->id;
            Expenses::destroy($expense_id);
            return redirect()->route('admin.expenses.index')->with('delete', 'Expense /s Delete Successfully');
        }else {
            return redirect()->back();
        }
    }
}
