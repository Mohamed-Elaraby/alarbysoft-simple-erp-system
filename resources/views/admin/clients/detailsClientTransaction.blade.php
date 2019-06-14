@extends('layouts.admin')

@section('title','Admin Client Transaction')

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
                @if ($clientTransaction)
                    <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Client Transaction [ {{ $clientTransaction->name }} ]</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="clientTransaction" class="table table-bordered table-hover row-border">
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
                                        @foreach ($clientTransaction->transactions as $transaction)
                                            <tr>
                                                <td>{{ $transaction->id }}</td>
                                                <td>{{ $transaction->amount }}</td>
                                                <td>{{ $transaction->created_at }}</td>
                                                <td>{{ $transaction->user->name }}</td>
                                                <td>
                                                    @if ($transaction->saleOrder)
                                                        <a href="{{ route('admin.sales.order', $transaction->saleOrder->id) }}">Sales Order</a>
                                                    @elseif($transaction->clientPayment)
                                                        Payments
                                                    @elseif($transaction->clientCollecting)
                                                        Collecting
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
{{--                                    <tfoot>
                                        <tr>
                                            <th scope="col">Total</th>
                                            <td scope="col">{{ $clientTransaction->balance }}</td>
                                        </tr>
                                    </tfoot>--}}
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                @endif
            </div>
        </div>
    </div>
@push('scripts')
    <script>
        $(function () {
            $('#clientTransaction').DataTable({
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
