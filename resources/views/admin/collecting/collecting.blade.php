@extends('layouts.admin')

@section('title','Admin Collecting')

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
                <div class="collecting_table">
                    <form action="{{ route('admin.collecting.destroy') }}" method="post">
                        @csrf
                        @method('DELETE')
                        <table id="collecting_table" class="table table-bordered table-hover table-striped">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Amount</th>
                                <th scope="col">collecting Date</th>
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
                            @foreach($collecting as $collect)
                                <tr>
                                    <th scope="col">{{ $collect->id }}</th>
                                    <td>{{ $collect->amount }}</td>
                                    <td>{{ $collect->payment_date }}</td>
                                    <td>{{ $collect->user->name }}</td>
                                    <td>{{ $collect->client->name }}</td>
                                    <td>{{ $collect->comment }}</td>
                                    <td>{{ $collect->created_at }}</td>
                                    <td>{{ $collect->updated_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.collecting.edit', $collect->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <a href="#" class="btn btn-sm btn-warning">Details</a></td>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="id[]" value="{{ $collect->id }}">
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
                $('#collecting_table').DataTable({
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
