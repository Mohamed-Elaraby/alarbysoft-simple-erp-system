@extends('layouts.admin')

@section('title','Admin Supplier Collecting')

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
                <div class="payments_table">
                    <form action="{{ route('admin.supplierCollecting.destroy') }}" method="post">
                        @csrf
                        @method('DELETE')
                        <table id="payments_table" class="table table-bordered table-hover table-striped">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Collecting Date</th>
                                <th scope="col">Agent</th>
                                <th scope="col">Client</th>
                                <th scope="col">Comment</th>
                                <th scope="col">Created_at</th>
                                <th scope="col">Updated_at</th>
                                <th scope="col">Action</th>
                                <th scope="col">Select</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($supplierCollecting as $collecting)
                                <tr>
                                    <th scope="col">{{ $collecting->id }}</th>
                                    <td>{{ $collecting->amount }}</td>
                                    <td>{{ $collecting->collecting_date }}</td>
                                    <td>{{ $collecting->user->name }}</td>
                                    <td>{{ $collecting->supplier->name }}</td>
                                    <td>{{ $collecting->comment }}</td>
                                    <td>{{ $collecting->created_at }}</td>
                                    <td>{{ $collecting->updated_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.supplierCollecting.edit', $collecting->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="id[]" value="{{ $collecting->id }}">
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
                $('#payments_table').DataTable({
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
