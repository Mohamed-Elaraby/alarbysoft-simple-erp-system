@extends('layouts.admin')

@section('title','Admin Create Payments')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-offset-3 col-sm-6">
            <h3 class="text-center"><i class="fa fa-edit"></i> Create Client Payments</h3>
            <form action="{{ route('admin.clientPayments.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input name="amount" type="text" class="form-control" id="amount">
                </div>

                <div class="form-group">
                    <label for="expense_date">Date</label>
                    <input name="payment_date" type="text" class="form-control" id="expense_date" data-date-format='yyyy-mm-dd'>
                </div>

                <div class="form-group">
                    <label for="client">Client</label>
                    <select name="client_id" id="client" class="form-control">
                        <option value=""></option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->name }}</option>
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
