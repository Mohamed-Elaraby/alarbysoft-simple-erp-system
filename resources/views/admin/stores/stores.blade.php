@extends('layouts.admin')

@section('title','Admin Stores')

@section('content')
    <div class="">
        <div class="row">
            <div class="col-md-12">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('delete'))
                    <div class="alert alert-danger">
                        {{ session('delete') }}
                    </div>
                @endif
                <div class="products_table">
                    <form action="{{ route('admin.destroyStore') }}" method="post">
                        @csrf
                        @method('DELETE')
                        <table class="table table-dark" id="Stores_table">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Store</th>
                                <th scope="col">address</th>
                                <th scope="col">phones</th>
                                <th scope="col">Created_by</th>
                                <th scope="col">created_at</th>
                                <th scope="col">updated_at</th>
                                <th scope="col">Action</th>
                                <th scope="col">Select</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($stores as $store)
                                <tr>
                                    <th scope="col">{{ $store->id }}</th>
                                    <td>{{ $store->name }}</td>
                                    <td>{{ $store->address }}</td>
                                    <td>{{ $store->phones }}</td>
                                    <td>{{ $store->user->name }}</td>
                                    <td>{{ $store->created_at }}</td>
                                    <td>{{ $store->updated_at }}</td>
                                    <td><a href="{{ route('admin.editStore', $store->id) }}" class="btn btn-sm btn-primary">Edit</a></td>
                                    <td>
                                        <input type="checkbox" name="id[]" value="{{ $store->id }}">
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <input type="submit" value="DELETE" name="softDelete" class="btn btn-danger">
                    </form>
                    <div id="show">

                    </div>
                    <div class="paginate col-md-offset-5">
                        {{ $stores->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
