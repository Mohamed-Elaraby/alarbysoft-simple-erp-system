@extends('layouts.admin')

@section('title','Admin Create Client')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-offset-3 col-sm-6">
            <h3 class="text-center"><i class="fa fa-edit"></i> Create Client</h3>
            <form action="{{ route('admin.clients.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="store">Client</label>
                    <input name="name" type="text" class="form-control" id="store" placeholder="Enter Client Name">
                </div>

                <div class="form-group">
                    <label for="client_type">Client Type</label>
                    <select name="client_type" id="client_type" class="form-control" required>
                        <option value="" readonly="">Choose Client Type</option>
                        <option value="0">Client</option>
                        <option value="1">Customer</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="phones">Phones</label>
                    <input name="phone" type="text" class="form-control" id="phones" placeholder="Enter Client Phones">
                </div>


                <div class="form-group">
                    <input type="submit" value="Create" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
