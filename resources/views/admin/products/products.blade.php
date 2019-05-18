@extends('layouts.admin')

@section('title','Admin Products')

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
                    <form action="{{ route('admin.destroyProduct') }}" method="post">
                        @csrf
                        @method('DELETE')
                        <table class="table table-dark" id="products_table">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Product</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">purchasing_price</th>
                                <th scope="col">dealer_price</th>
                                <th scope="col">selling_price</th>
                                <th scope="col">serialNumber</th>
                                <th scope="col">user</th>
                                <th scope="col">category</th>
                                <th scope="col">store</th>
                                <th scope="col">supplier</th>
                                <th scope="col">created_at</th>
                                <th scope="col">updated_at</th>
                                <th scope="col">Action</th>
                                <th scope="col">Select</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <th scope="col">{{ $product->id }}</th>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>{{ $product->purchasing_price }}</td>
                                    <td>{{ $product->dealer_price }}</td>
                                    <td>{{ $product->selling_price }}</td>
                                    <td>{{ $product->serialNumber }}</td>
                                    <td>{{ $product->user->name }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>{{ $product->store->name }}</td>
                                    <td>{{ $product->supplier->name }}</td>
                                    <td>{{ $product->created_at }}</td>
                                    <td>{{ $product->updated_at }}</td>
                                    <td><a href="{{ route('admin.editProduct', $product->id) }}" class="btn btn-sm btn-primary">Edit</a></td>
                                    <td>
                                        <input type="checkbox" name="id[]" value="{{ $product->id }}">
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
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@push('scripts')
{{--    <script>--}}
{{--        $(function() {--}}
{{--            $('#products_table').DataTable({--}}
{{--                processing: true,--}}
{{--                serverSide: true,--}}
{{--                ajax: '{!! route('admin.productsDataTable') !!}',--}}
{{--                columns: [--}}
{{--                    { data: 'id', name: 'id' },--}}
{{--                    { data: 'product', name: 'product' },--}}
{{--                    { data: 'price', name: 'price' },--}}
{{--                    { data: 'created_at', name: 'created_at' },--}}
{{--                    { data: 'updated_at', name: 'updated_at' },--}}
{{--                    { data: 'link', name: 'link', orderable: false, searchable: false},--}}
{{--                    { data: 'action', name: 'action', orderable: false, searchable: false},--}}
{{--                ]--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
@endpush
@endsection
