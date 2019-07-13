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
                <h3 class="text-center">Products</h3>
                <div class="products_table">
                    <form action="{{ route('admin.products.destroy') }}" method="post">
                        @csrf
                        @method('DELETE')
                        <table class="table table-dark table-striped table-hover" id="products_table">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Product</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">purchasing_price</th>
                                <th scope="col">dealer_price</th>
                                <th scope="col">selling_price</th>
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
                                    <td>{{ $product->purchase_price }}</td>
                                    <td>{{ $product->dealer_price }}</td>
                                    <td>{{ $product->selling_price }}</td>
                                    <td>{{ $product->created_at }}</td>
                                    <td>{{ $product->updated_at }}</td>
                                    <td><a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-primary">Edit</a></td>
                                    <td>
                                        <input type="checkbox" name="id[]" value="{{ $product->id }}">
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <input type="submit" value="DELETE" name="softDelete" class="btn btn-danger">
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(function () {
                $('#products_table').DataTable({
                    dom: 'lBfrtip',// dom: 'B<"clear">lfrtip',
                    // buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                    "buttons": [
                        { "extend": 'copy', "text":'Copy',"className": 'btn btn-default btn-xs' },
                        { "extend": 'csv', "text":'Csv',"className": 'btn btn-default btn-xs' },
                        { "extend": 'excel', "text":'Excel',"className": 'btn btn-default btn-xs' },
                        { "extend": 'pdf', "text":'Pdf',"className": 'btn btn-default btn-xs' },
                        { "extend": 'print', "text":'Print',"className": 'btn btn-default btn-xs' },
                    ],
                    responsive: true,
                    // scrollY:        "400vh",
                    // scrollX:        true,
                    // scrollCollapse: true,
                    paging:         true,
                    fixedColumns:   {
                        heightMatch: 'none'
                    },
                    "ordering": true,
                    "order": [[ 0, "desc" ]],
                })
            })
        </script>
    @endpush
@endsection
