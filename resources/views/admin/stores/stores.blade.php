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
                <h3 class="text-center">Stores</h3>
                <div class="stores_table">
                    <form action="{{ route('admin.stores.destroy') }}" method="post">
                        @csrf
                        @method('DELETE')
                        <table id="stores_table" class="table table-bordered table-hover table-striped">
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
                                    <td><a href="{{ route('admin.stores.edit', $store->id) }}" class="btn btn-sm btn-primary">Edit</a></td>
                                    <td>
                                        <input type="checkbox" name="id[]" value="{{ $store->id }}">
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
                $('#stores_table').DataTable({
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
