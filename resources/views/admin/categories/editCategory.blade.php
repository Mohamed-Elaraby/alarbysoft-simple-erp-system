@extends('layouts.admin')

@section('title','Admin Edit Category')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-offset-3 col-sm-6">
                <h3 class="text-center"><i class="fa fa-edit"></i> Edit Category</h3>
                <form action="{{ route('admin.updateCategory', $category->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="product">Category</label>
                        <input name="name" type="text" class="form-control" id="product" value="{{ $category->name }}">
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" id="" cols="30" rows="10">{{ $category->description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="parent">Parent?</label>
                        <select name="parent" id="parent" class="form-control">
                            <option value="0"></option>
                            @foreach($allCategories as $cat)
                                <option value="{{ $cat->id }}" {{ $cat->id == $category->type ? 'selected':'' }}>{{ $cat->name }}</option>
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
