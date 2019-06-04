@extends('layouts.admin')

@section('title','Admin Edit Expenses Type')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-offset-3 col-sm-6">
                <h3 class="text-center"><i class="fa fa-edit"></i> Edit Expenses Type</h3>
                <form action="{{ route('admin.expensesTypes.update', $expense->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="type">Type</label>
                        <input name="name" type="text" class="form-control" id="type" placeholder="Enter Expense Amount" value="{{ $expense->name }}">
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Update" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
