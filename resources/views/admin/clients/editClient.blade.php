@extends('layouts.admin')

@section('title','Admin Edit Supplier')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-offset-3 col-sm-6">
                <h3 class="text-center"><i class="fa fa-edit"></i> Edit Supplier</h3>
                <form action="{{ route('admin.updateSupplier', $supplier->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="store">Supplier</label>
                        <input name="name" type="text" class="form-control" id="store" value="{{ $supplier->name }}">
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <input name="address" type="text" class="form-control" id="address" value="{{ $supplier->address }}">
                    </div>

                    <div class="form-group">
                        <label for="phones">Phones</label>
                        <input name="phones" type="text" class="form-control" id="phones" value="{{ $supplier->phones }}">
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Update" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
