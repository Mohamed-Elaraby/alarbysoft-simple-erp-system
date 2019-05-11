@extends('layouts.admin')

@section('title','Admin Products')

@section('content')
    <div class="container">
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
                                <th scope="col">price</th>
                                <th scope="col">created_at</th>
                                <th scope="col">updated_at</th>
                                <th scope="col">Action</th>
                                <th scope="col">Select</th>
                            </tr>
                            </thead>
                        </table>
                        <input type="submit" value="DELETE" name="softDelete" class="btn btn-danger">
                    </form>
                    <div id="show">

                    </div>
                </div>
            </div>
        </div>
    </div>
@push('scripts')
    <script>
        $(function() {
            $('#products_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('admin.productsDataTable') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'product', name: 'product' },
                    { data: 'price', name: 'price' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'updated_at', name: 'updated_at' },
                    { data: 'link', name: 'link', orderable: false, searchable: false},
                    { data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
@endpush
@endsection
