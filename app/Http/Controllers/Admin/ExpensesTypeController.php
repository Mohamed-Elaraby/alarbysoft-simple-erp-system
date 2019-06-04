<?php

namespace App\Http\Controllers\Admin;

use App\ExpensesType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExpensesTypeController extends Controller
{
    public function index()
    {
        $expensesTypes = ExpensesType::all();
        return view('admin.expensesTypes.expensesTypes', compact('expensesTypes'));
    }

    public function create()
    {
        return view('admin.expensesTypes.createExpensesTypes');
    }

    public function store(Request $request)
    {
        ExpensesType::create($request->all());
        return redirect()->route('admin.expensesTypes.index')->with('success', 'Expenses Added Successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $expense = ExpensesType::findOrFail($id);
        return view('admin.expensesTypes.editExpensesTypes', compact('expense'));
    }

    public function update(Request $request, $id)
    {
        ExpensesType::findOrFail($id)->update($request->all());
        return redirect()->route('admin.expensesTypes.index')->with('success', 'Expenses Updated Successfully');

    }

    public function destroy(Request $request)
    {
        if (isset($request->id)){
            $expense_type_id = $request->id;
            ExpensesType::destroy($expense_type_id);
            return redirect()->route('admin.expensesTypes.index')->with('delete', 'Client /s Delete Successfully');
        }else {
            return redirect()->back();
        }
    }
}
