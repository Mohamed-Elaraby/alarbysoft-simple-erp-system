@extends('layouts.admin')

@section('title','Admin Create Product')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-offset-3 col-sm-6">
            <h3 class="text-center"><i class="fa fa-plus"></i> Create Product</h3>
            <form action="{{ route('admin.storeProduct') }}" method="POST" id="add_product_form">
                @csrf
                <div class="form-group">
                    <label for="product">Product</label>
                    <input name="product" type="text" class="form-control" id="product" placeholder="Enter Product Name">
                </div>

                <div class="form-group">
                    <label for="price">Price</label>
                    <input name="price" type="text" class="form-control" id="price" placeholder="10.0">
                </div>
                <div class="form-group">
                    <input type="submit" value="Create" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
