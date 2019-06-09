@extends('layouts.admin')

@section('title','Admin Edit Collecting')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-offset-3 col-sm-6">
                <h3 class="text-center"><i class="fa fa-edit"></i> Edit Coolecting</h3>
                <form action="{{ route('admin.supplierPayments.update', $supplierPayment->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input name="amount" type="text" class="form-control" id="amount" value="{{ $supplierPayment->amount }}">
                    </div>

                    <div class="form-group">
                        <label for="payment_date">Date</label>
                        <input name="payment_date" type="text" class="form-control" id="payment_date"  data-date-format='yyyy-mm-dd' value="{{ $supplierPayment->payment_date }}">
                    </div>

                    <div class="form-group">
                        <label for="client">Client</label>
                        <select name="client_id" id="client" class="form-control">
                            <option value=""></option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" {{ $supplier->id == $supplierPayment->supplier_id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="comment">Comment</label>
                        <textarea name="comment" id="comment" cols="30" rows="5" class="form-control">{{ $supplierPayment->comment }}</textarea>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Update" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $('#payment_date').datepicker();
        </script>
    @endpush
@endsection
