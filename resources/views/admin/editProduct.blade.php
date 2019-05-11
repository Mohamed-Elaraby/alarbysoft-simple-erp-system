@extends('layouts.admin')

@section('title','Admin Edit Product')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-offset-3 col-sm-6">
                <h3 class="text-center"><i class="fa fa-edit"></i> Edit Product</h3>
                <form action="{{ route('admin.updateProduct', $product->id) }}" method="POST" id="add_product_form">
                    @csrf
                    <div class="form-group">
                        <label for="product">Product</label>
                        <input name="product" type="text" class="form-control" id="product" placeholder="Enter Product Name" value="{{ $product->product }}">
                    </div>

                    <div class="form-group">
                        <label for="price">Price</label>
                        <input name="price" type="text" class="form-control" id="price" placeholder="10.0" value="{{ $product->price }}">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Update" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
