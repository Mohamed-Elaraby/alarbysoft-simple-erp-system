@extends('layouts.admin')

@section('title','Admin Supplier Transaction')

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
                @if ($supplier)
                    <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Supplier Transaction [ {{ $supplier->name }} ]</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="supplierTransaction" class="table table-bordered table-hover row-border">
                                    <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">transaction_date</th>
                                        <th scope="col">Agent</th>
                                        <th scope="col">References</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($supplier->supplierTransactions as $transaction)
                                        <tr>
                                            <td>{{ $transaction->id }}</td>
                                            <td>{{ $transaction->amount }}</td>
                                            <td>{{ $transaction->transaction_date }}</td>
                                            <td>{{ $transaction->user->name }}</td>
                                            <td>
                                               @if ($transaction->purchaseOrder)
                                                    <a href="{{ route('admin.purchases.order', $transaction->purchaseOrder->id) }}">Purchase Order</a>
                                               @elseif($transaction->supplierPayment)
                                                    Payments
                                                @elseif($transaction->supplierCollecting)
                                                    Collecting
                                               @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                @else
                    no data
                @endif
            </div>
        </div>
    </div>
@push('scripts')
    <script>
        $(function () {
            $('#supplierTransaction').DataTable({
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
                // scrollY:        "300px",
                // scrollX:        true,
                // scrollCollapse: true,
                // paging:         true,
                // fixedColumns:   {
                //     heightMatch: 'none'
                // },
                "ordering": true,
                "order": [[ 0, "desc" ]],
            })
        })
    </script>
@endpush
@endsection
