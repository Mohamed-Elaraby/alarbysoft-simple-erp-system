@extends('layouts.admin')

@section('title','Admin Expenses')

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
                <h3 class="text-center">Expenses</h3>
                <div class="expenses_table">
                    <form action="{{ route('admin.expenses.destroy') }}" method="post">
                        @csrf
                        @method('DELETE')
                        <table id="expenses_table" class="table table-bordered table-hover table-striped">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Comment</th>
                                <th scope="col">Expenses Date</th>
                                <th scope="col">Expenses Type</th>
                                <th scope="col">Agent</th>
                                <th scope="col">Created_at</th>
                                <th scope="col">Updated_at</th>
                                <th scope="col">Action</th>
                                <th scope="col">Select</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($expenses as $expense)
                                <tr>
                                    <th scope="col">{{ $expense->id }}</th>
                                    <td>{{ $expense->amount }}</td>
                                    <td>{{ $expense->comment }}</td>
                                    <td>{{ $expense->expenses_date }}</td>
                                    <td>{{ $expense->expensesType->name }}</td>
                                    <td>{{ $expense->user->name }}</td>
                                    <td>{{ $expense->created_at }}</td>
                                    <td>{{ $expense->updated_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.expenses.edit', $expense->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="id[]" value="{{ $expense->id }}">
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
                $('#expenses_table').DataTable({
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
