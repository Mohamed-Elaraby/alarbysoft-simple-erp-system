@extends('layouts.admin')

@section('title','Admin Purchases')

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
                    <form action="{{ route('admin.destroyPurchases') }}" method="post">
                        @csrf
                        @method('DELETE')
                        <table class="table table-dark" id="Purchasess_table">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Invoice Number</th>
                                <th scope="col">Product</th>
                                <th scope="col">price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Method</th>
                                <th scope="col">Discount</th>
                                <th scope="col">Paid</th>
                                <th scope="col">Stay</th>
                                <th scope="col">Total</th>
                                <th scope="col">Store</th>
                                <th scope="col">Created_by</th>
                                <th scope="col">Supplier</th>
                                <th scope="col">created_at</th>
                                <th scope="col">updated_at</th>
                                <th scope="col">Action</th>
                                <th scope="col">Select</th>
                            </tr>
                            </thead>
{{--                            'name', 'price', 'method', 'discount', 'user_id', 'store_id', 'supplier_id', 'quantity', 'invoice', 'paid', 'stay', 'total',--}}

                            <tbody>
                            @foreach($purchases as $item)
                                <tr>
                                    <th scope="col">{{ $item->id }}</th>
                                    <td>{{ $item->invoice }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->method }}</td>
                                    <td>{{ $item->discount }}</td>
                                    <td>{{ $item->paid }}</td>
                                    <td>{{ $item->stay }}</td>
                                    <td>{{ $item->total }}</td>
                                    <td>{{ $item->store }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->supplier->name }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->updated_at }}</td>
                                    <td><a href="{{ route('admin.editPurchases', $item->id) }}" class="btn btn-sm btn-primary">Edit</a></td>
                                    <td>
                                        <input type="checkbox" name="id[]" value="{{ $item->id }}">
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
                        {{ $purchases->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
