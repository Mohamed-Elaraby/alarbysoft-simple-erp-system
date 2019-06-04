@extends('layouts.admin')

@section('title','Admin Create Expense')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-offset-3 col-sm-6">
            <h3 class="text-center"><i class="fa fa-edit"></i> Create Expense</h3>
            <form action="{{ route('admin.expenses.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input name="amount" type="text" class="form-control" id="amount">
                </div>

                <div class="form-group">
                    <label for="expense_date">Date</label>
                    <input name="expenses_date" type="text" class="form-control" id="expense_date" data-date-format='yyyy-mm-dd'>
                </div>

                <div class="form-group">
                    <label for="expense_type">Type</label>
                    <select name="expenses_type_id" id="expense_type" class="form-control">
                        <option value=""></option>
                        @foreach($expensesType as $expense)
                            <option value="{{ $expense->id }}">{{ $expense->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="store">Store</label>
                    <select name="store" id="store" class="form-control">
                        <option value=""></option>
                        @foreach($stores as $store)
                            <option value="{{ $store->id }}">{{ $store->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="comment">Comment</label>
                    <textarea name="comment" id="comment" cols="30" rows="5" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <input type="submit" value="Create" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $("#expense_date").datepicker().datepicker("setDate", new Date());
    </script>
@endpush
@endsection
