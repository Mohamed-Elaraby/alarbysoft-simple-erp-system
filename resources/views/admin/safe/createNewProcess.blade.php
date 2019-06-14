@extends('layouts.admin')

@section('title','Admin Create New Process')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-offset-3 col-sm-6">
            <h3 class="text-center"><i class="fa fa-edit"></i> Create New Process</h3>
            <form action="{{ route('admin.safe.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input name="amount" type="text" class="form-control" id="amount">
                </div>

                <div class="form-group">
                    <label for="processType">Type</label>
                    <select name="processType" id="processType" class="form-control">
                        <option value=""></option>
                        <option value="0">Cash</option>
                        <option value="1">Deposit</option>
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

@endpush
@endsection
