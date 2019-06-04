@extends('layouts.admin')

@section('title','Admin Purchases Order Details')

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
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Purchases Order Number {{ $sale_orders->invoiceNo }} Products Details</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="purchaseOrderProducts" class="table table-bordered table-hover row-border">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Product</th>
                                <th scope="col">price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($sale_orders->saleOrderProducts as $value)
                                <tr>
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->price }}</td>
                                    <td>{{ $value->quantity }}</td>
                                    <td>{{ $value->total }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Product</th>
                                <th scope="col">price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </div>
@push('scripts')
    <script>
        $(function () {
            $('#purchaseOrderProducts').DataTable({
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
