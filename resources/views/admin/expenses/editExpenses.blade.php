@extends('layouts.admin')

@section('title','Admin Edit Expenses')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-offset-3 col-sm-6">
                <h3 class="text-center"><i class="fa fa-edit"></i> Edit Expenses</h3>
                <form action="{{ route('admin.expenses.update', $expense->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input name="amount" type="text" class="form-control" id="amount" value="{{ $expense->amount }}">
                    </div>

                    <div class="form-group">
                        <label for="expense_date">Date</label>
                        <input name="expenses_date" type="text" class="form-control" id="expense_date" value="{{ $expense->expenses_date }}">
                    </div>

                    <div class="form-group">
                        <label for="expense_type">Type</label>
                        <select name="expenses_type_id" id="expense_type" class="form-control">
                            @foreach($expensesType as $expenses)
                                <option value="{{ $expenses->id }}" {{ $expenses->id == $expense->expenses_type_id ? 'selected' : '' }}>{{ $expenses->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="store">Store</label>
                        <select name="store" id="store" class="form-control">
                            <option value=""></option>
                            @foreach($stores as $store)
                                <option value="{{ $store->id }}" {{ $store->id == $expense->store_id ? 'selected' : '' }}>{{ $store->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="comment">Comment</label>
                        <textarea name="comment" id="comment" cols="30" rows="5" class="form-control">{{ $expense->comment }}</textarea>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Update" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
