@extends('layouts.admin')

@section('title','Admin Edit Store')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-offset-3 col-sm-6">
                <h3 class="text-center"><i class="fa fa-edit"></i> Edit Store</h3>
                <form action="{{ route('admin.updateStore', $store->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="store">Store</label>
                        <input name="name" type="text" class="form-control" id="store" value="{{ $store->name }}">
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <input name="address" type="text" class="form-control" id="address" value="{{ $store->address }}">
                    </div>

                    <div class="form-group">
                        <label for="phones">Phones</label>
                        <input name="phones" type="text" class="form-control" id="phones" value="{{ $store->phones }}">
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Update" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
