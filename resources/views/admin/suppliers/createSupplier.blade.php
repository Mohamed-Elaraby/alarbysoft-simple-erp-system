@extends('layouts.admin')

@section('title','Admin Create Supplier')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-offset-3 col-sm-6">
            <h3 class="text-center"><i class="fa fa-edit"></i> Create Supplier</h3>
            <form action="{{ route('admin.suppliers.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="store">Supplier</label>
                    <input name="name" type="text" class="form-control" id="store" placeholder="Enter Supplier Name">
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <input name="address" type="text" class="form-control" id="address" placeholder="Enter Supplier Address">
                </div>

                <div class="form-group">
                    <label for="phones">Phones</label>
                    <input name="phones" type="text" class="form-control" id="phones" placeholder="Enter Supplier Phones">
                </div>

                <div class="form-group">
                    <input type="submit" value="Create" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
