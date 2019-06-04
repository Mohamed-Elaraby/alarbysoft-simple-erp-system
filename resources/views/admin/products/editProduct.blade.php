@extends('layouts.admin')

@section('title','Admin Edit Product')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-offset-3 col-sm-6">
                <h3 class="text-center"><i class="fa fa-edit"></i> Create Product</h3>
                <form action="{{ route('admin.products.update', $product->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Product</label>
                        <input name="name" type="text" class="form-control" id="name" placeholder="Enter Product Name" value="{{ $product->name }}">
                    </div>

                    <div class="form-group">
                        <label for="purchasing_price">Purchasing_price</label>
                        <input name="purchase_price" type="text" class="form-control" id="purchasing_price" placeholder="10.0" value="{{ $product->purchase_price }}">
                    </div>

                    <div class="form-group">
                        <label for="dealer_price">Dealer_price</label>
                        <input name="dealer_price" type="text" class="form-control" id="dealer_price" placeholder="10.0" value="{{ $product->dealer_price }}">
                    </div>

                    <div class="form-group">
                        <label for="selling_price">Selling_price</label>
                        <input name="selling_price" type="text" class="form-control" id="selling_price" placeholder="10.0" value="{{ $product->selling_price }}">
                    </div>

                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input name="quantity" type="text" class="form-control" id="quantity" placeholder="Please Enter Product Quantity" value="{{ $product->quantity }}">
                    </div>

                    <div class="form-group">
                        <label for="category">Category</label>
                        <select name="category" id="category" class="form-control">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == $product->category_id? 'selected':'' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="store">Store</label>
                        <select name="store" id="store" class="form-control">
                            @foreach($stores as $store)
                                <option value="{{ $store->id }}" {{ $store->id == $product->store_id? 'selected':'' }}>{{ $store->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="supplier">Suppliers</label>
                        <select name="supplier" id="supplier" class="form-control">
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" {{ $supplier->id == $product->supplier_id? 'selected':'' }}>{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Update" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
