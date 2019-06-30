@extends('layouts.admin')

@section('title','Admin Sales Order Details')

@section('content')

@push('links')

@endpush
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Invoice
            <small>#{{ $salesOrder->invoiceNo }}</small>
        </h1>
        <h1>
            Agent
            <small>{{ $salesOrder->user->name }}</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <i class="fa fa-globe"></i> alaraby, co.
                    @php
                        $myDateTime = DateTime::createFromFormat('Y-m-d', $salesOrder->invoiceDate);
                        $formattedweddingdate = $myDateTime->format('d/m/Y');
                    @endphp
                    <small class="pull-right">Date: {{ $formattedweddingdate }}</small>
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-6 invoice-col">
                From
                <address>
                    <strong>alaraby, co.</strong><br>
                    Al-Gomhouria Street, Al-Saqr Mall<br>
                    Port Said, CA 94107<br>
                    Phone   : (+20) 120-897-1447<br>
                    Email   : info@alarabystore.com<br>
                    Website : www.alarabystore.com
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-6 invoice-col">
                To
                <address>
                    <strong>{{ $salesOrder->client->name }}</strong><br>
                    Phone: {{ $salesOrder->client->phones != '' ? $salesOrder->client->phones : '___'  }}
                </address>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped" id="sale_orders">
                    <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                        <th>Serial</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($salesOrder->saleOrderProducts as $order)
                        <tr>
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->quantity }}</td>
                            <td>{{ $order->price }} EGP</td>
                            <td>{{ $order->total }} EGP</td>
                            <td>{{ $order->serial }}</td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="m" style="margin-top: 10px;">
            <div class="row">
                <!-- accepted payments column -->
                <div class="col-xs-6">
                    <p class="lead">Payment Methods:</p>
                    <img src="{{ asset('admin/img/credit/visa.png') }}" alt="Visa">
                    <img src="{{ asset('admin/img/credit/mastercard.png') }}" alt="Mastercard">
                    <img src="{{ asset('admin/img/credit/american-express.png') }}" alt="American Express">
                    <img src="{{ asset('admin/img/credit/paypal2.png') }}" alt="Paypal">

                    <div class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                        <strong> Important: </strong>
                        <ol>
                            <li>
                                This is an electronic generated invoice so doesn't require any signature.

                            </li>
                            <li>
                                Please read all terms and polices on  www.alarabystore.com/terms for returns, replacement and other issues.

                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-6">

                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th style="width:50%">Subtotal:</th>
                                <td>{{ $total_amount_products }} EGP</td>
                            </tr>

                            @if ($salesOrder->tax_percent)
                                <div class="ttl-amts">
                                    <h5>  Tax : {{ $salesOrder->tax }} EGP ( by {{ $salesOrder->tax_percent }} % on bill ) </h5>
                                </div>
                                <hr />
                                <tr>
                                    <th>Tax ({{ $salesOrder->tax_percent }} %)</th>
                                    <td>{{ $salesOrder->tax }} EGP</td>
                                </tr>
                            @endif
                            <tr>
                                <th>Total:</th>
                                <td>{{ $salesOrder->invoice_total }} EGP</td>
                            </tr>

                            <tr>
                                <th>Amount Paid:</th>
                                <td>{{ $salesOrder->amount_paid }} EGP</td>
                            </tr>

                            <tr>
                                <th>Amount Due:</th>
                                <td>{{ $salesOrder->amount_due }} EGP</td>
                            </tr>

                        </table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
        </div>
        <!-- /.row -->

        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
                <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
                </button>
                <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
                    <i class="fa fa-download"></i> Generate PDF
                </button>
            </div>
        </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
</div>

@push('scripts')
    <script>
        $(function () {
            $('#sale_orders').DataTable({
                // dom: 'lBfrtip',// dom: 'B<"clear">lfrtip',
                // buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                // "buttons": [
                //     { "extend": 'copy', "text":'Copy',"className": 'btn btn-default btn-xs' },
                //     { "extend": 'csv', "text":'Csv',"className": 'btn btn-default btn-xs' },
                //     { "extend": 'excel', "text":'Excel',"className": 'btn btn-default btn-xs' },
                //     { "extend": 'pdf', "text":'Pdf',"className": 'btn btn-default btn-xs' },
                //     { "extend": 'print', "text":'Print',"className": 'btn btn-default btn-xs' },
                // ],
                responsive: true,
                // scrollY:        "300px",
                // scrollX:        true,
                // scrollCollapse: true,
                // paging:         true,
                // fixedColumns:   {
                //     heightMatch: 'none'
                // },
                "searching": false,
                "ordering": true,
                // "order": [[ 0, "desc" ]],
                // "bLengthChange": false,
                "lengthMenu": [[10, 11, 12, 13, 14, 15, 25, 50, -1], [10, 11, 12, 13, 14, 15, 25, 50, "All"]]
            })
        })
    </script>
@endpush
@endsection
