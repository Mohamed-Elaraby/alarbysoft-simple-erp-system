@extends('layouts.admin')

@section('title','Admin Create Store')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-offset-3 col-sm-6">
            <h3 class="text-center"><i class="fa fa-edit"></i> Create Store <button id="button">New Row</button></h3>
            <form action="{{ route('admin.storeStore') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="store">Store</label>
                    <input name="name" type="text" class="form-control" id="store" placeholder="Enter Store Name">
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <input name="address" type="text" class="form-control" id="address" placeholder="Enter Store Address">
                </div>

                <div class="form-group">
                    <label for="phones">Phones</label>
                    <input name="phones" type="text" class="form-control" id="phones" placeholder="Enter Store Phones">
                </div>

                <div class="form-group">
                    <input type="submit" value="Create" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
