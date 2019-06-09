@extends('layouts.admin')

@section('title','Admin Create Supplier Payment')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-offset-3 col-sm-6">
            <h3 class="text-center"><i class="fa fa-edit"></i> Create Supplier Payment</h3>
            <form action="{{ route('admin.supplierPayments.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input name="amount" type="text" class="form-control" id="amount">
                </div>

                <div class="form-group">
                    <label for="payment_date">Date</label>
                    <input name="payment_date" type="text" class="form-control" id="payment_date" data-date-format='yyyy-mm-dd'>
                </div>

                <div class="form-group">
                    <label for="supplier">Supplier</label>
                    <select name="supplier_id" id="supplier" class="form-control">
                        <option value=""></option>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
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
        $("#payment_date").datepicker().datepicker("setDate", new Date());
    </script>
@endpush
@endsection
