@extends('layouts.admin')

@section('title','Admin Clients')

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
                <div class="clients_table">
                    <form action="{{ route('admin.clients.destroy') }}" method="post">
                        @csrf
                        @method('DELETE')
                        <table id="clients_table" class="table table-bordered table-hover table-striped">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Client</th>
                                <th scope="col">Balance</th>
                                <th scope="col">phones</th>
                                <th scope="col">Created_by</th>
                                <th scope="col">created_at</th>
                                <th scope="col">updated_at</th>
                                <th scope="col">Action</th>
                                <th scope="col">Details</th>
                                <th scope="col">Select</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($clients as $client)
                                <tr>
                                    <th scope="col">{{ $client->id }}</th>
                                    <td>{{ $client->name }}</td>
                                    <td class="bg-primary">{{ $client->balance }}</td>
                                    <td>{{ $client->phones }}</td>
                                    <td>{{ $client->user->name }}</td>
                                    <td>{{ $client->created_at }}</td>
                                    <td>{{ $client->updated_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.clients.edit', $client->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.clients.show', $client->id) }}" class="btn btn-sm btn-warning">Details</a></td>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="id[]" value="{{ $client->id }}">
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                                <th>Total</th>
                                <td></td>
                                <td>
                                    @if ( $totalClientsAccountsBalance > 0 )
                                        {{ $totalClientsAccountsBalance }} CR
                                    @elseif( $totalClientsAccountsBalance < 0 )
                                        {{ $totalClientsAccountsBalance }} DE
                                    @else
                                        {{ $totalClientsAccountsBalance }}
                                    @endif
                                </td>
                            </tfoot>
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
                $('#clients_table').DataTable({
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
