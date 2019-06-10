@extends('layouts.admin')

@section('title','Admin Edit payments')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-offset-3 col-sm-6">
                <h3 class="text-center"><i class="fa fa-edit"></i> Edit payments</h3>
                <form action="{{ route('admin.clientPayments.update', $payment->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input name="amount" type="text" class="form-control" id="amount" value="{{ $payment->amount }}">
                    </div>

                    <div class="form-group">
                        <label for="expense_date">Date</label>
                        <input name="payment_date" type="text" class="form-control" id="expense_date" value="{{ $payment->payment_date }}">
                    </div>

                    <div class="form-group">
                        <label for="client">Client</label>
                        <select name="client_id" id="client" class="form-control">
                            <option value=""></option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}" {{ $client->id == $payment->client_id ? 'selected' : '' }}>{{ $client->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="comment">Comment</label>
                        <textarea name="comment" id="comment" cols="30" rows="5" class="form-control">{{ $payment->comment }}</textarea>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Update" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
