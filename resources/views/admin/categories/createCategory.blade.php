@extends('layouts.admin')

@section('title','Admin Create Category')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-offset-3 col-sm-6">
            <h3 class="text-center"><i class="fa fa-edit"></i> Create Category</h3>
            <form action="{{ route('admin.storeCategory') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="product">Category</label>
                    <input name="name" type="text" class="form-control" id="product" placeholder="Enter Category Name">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" id="" cols="30" rows="10"></textarea>
                </div>

                <div class="form-group">
                    <label for="parent">Parent?</label>
                    <select name="parent" id="parent" class="form-control">
                        <option value="0"></option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <input type="submit" value="Create" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
