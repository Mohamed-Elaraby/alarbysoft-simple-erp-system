@extends('layouts.admin')

@section('title','Admin Edit Serial')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-offset-3 col-sm-6">
                <h3 class="text-center"><i class="fa fa-edit"></i> Edit Serial</h3>
                <form action="{{ route('admin.serials.update', $serial->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="product">Products</label>
                        <select name="product_id" id="product" class="form-control">
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" {{ $product->id == $serial->product_id ? 'selected' : '' }}>{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="serial">Serial</label>
                        <input name="serial" type="text" class="form-control" id="serial" value="{{ $serial->serial }}">
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="0" {{ $serial->status == 0 ? 'selected' : '' }}>Available</option>
                            <option value="1" {{ $serial->status == 1 ? 'selected' : '' }}>Sold</option>
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
