@extends('layouts.admin')

@section('title','Admin Create New Process')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-offset-3 col-sm-6">
            <h3 class="text-center"><i class="fa fa-edit"></i> Create New Process</h3>
            <form action="{{ route('admin.equityCapital.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input name="amount_paid" type="text" class="form-control" id="amount">
                </div>

                <div class="form-group">
                    <label for="processType">Cash/Deposit</label>
                    <select name="processType" id="processType" class="form-control">
                        <option value=""></option>
                        <option value="0">Cash</option>
                        <option value="1">Deposit</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="processType">Amount To The Safe</label>
                    <select name="action" id="action" class="form-control" disabled="disabled">
                        <option value=""></option>
                        <option value="0">Dont Add Amount To The Safe</option>
                        <option value="1">Add Amount To The Safe</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="comment">Comment</label>
                    <textarea name="comment" id="comment" cols="30" rows="5" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <input type="submit" value="Process" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $("#processType").change(function () {
            var processType = $('#processType option:selected').val();
            if (processType == 1){
                $('#action').removeAttr('disabled');
            } else{
                $('#action').prop('disabled', 'disabled');
            }
        });
    </script>
@endpush
@endsection
