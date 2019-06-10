@extends('layouts.admin')

@section('title','Admin Suppliers')

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
                <div class="suppliers_table">
                    <form action="{{ route('admin.suppliers.destroy') }}" method="post">
                        @csrf
                        @method('DELETE')
                        <table id="suppliers_table" class="table table-bordered table-hover table-striped">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Supplier</th>
                                <th scope="col">Balance</th>
                                <th scope="col">Address</th>
                                <th scope="col">Phones</th>
                                <th scope="col">Agent</th>
                                <th scope="col">created_at</th>
                                <th scope="col">updated_at</th>
                                <th scope="col">Action</th>
                                <th scope="col">Details</th>
                                <th scope="col">Select</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($suppliers as $supplier)
{{--                                @php--}}
{{--                                    $purchaseOrder_due = $supplier->purchases->sum('amount_due');--}}
{{--                                    $supplierPayments = $supplier->supplierPayment->sum('amount');--}}
{{--                                    $suppliercollecting = $supplier->supplierCollecting->sum('amount');--}}
{{--                                    $balance = $purchaseOrder_due + $suppliercollecting - $supplierPayments  ;--}}
{{--                                @endphp--}}
                                <tr>
                                    <th scope="col">{{ $supplier->id }}</th>
                                    <td>{{ $supplier->name }}</td>
                                    <td class="bg-primary">{{ $supplier->balance }}</td>
                                    <td>{{ $supplier->address }}</td>
                                    <td>{{ $supplier->phones }}</td>
                                    <td>{{ $supplier->user->name }}</td>
                                    <td>{{ $supplier->created_at }}</td>
                                    <td>{{ $supplier->updated_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.suppliers.edit', $supplier->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.suppliers.show', $supplier->id) }}" class="btn btn-sm btn-warning">Details</a>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="id[]" value="{{ $supplier->id }}">
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
                $('#suppliers_table').DataTable({
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
