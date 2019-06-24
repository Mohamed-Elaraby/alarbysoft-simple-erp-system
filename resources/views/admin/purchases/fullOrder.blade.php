@extends('layouts.admin')

@section('title','Admin Purchases Order Details')

@section('content')

@push('links')

@endpush
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Invoice
            <small>#{{ $purchaseOrder->invoiceNo }}</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <i class="fa fa-globe"></i> AdminLTE, Inc.
                    <small class="pull-right">Date: {{ $purchaseOrder->invoiceDate }}</small>
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-6 invoice-col">
                From
                <address>
                    <strong>Admin, Inc.</strong><br>
                    795 Folsom Ave, Suite 600<br>
                    San Francisco, CA 94107<br>
                    Phone: (804) 123-5432<br>
                    Email: info@almasaeedstudio.com
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-6 invoice-col">
                To
                <address>
                    <strong>{{ $purchaseOrder->client->name }}</strong><br>
                    795 Folsom Ave, Suite 600<br>
                    San Francisco, CA 94107<br>
                    Phone: (555) 539-1037<br>
                    Email: john.doe@example.com
                </address>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped" id="purchase_fullOrder">
                    <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($purchaseOrder->purchaseOrderProducts as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->quantity }}</td>
                            <td>{{ $order->price }} EGP</td>
                            <td>{{ $order->total }} EGP</td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-6">
                <p class="lead">Payment Methods:</p>
                <img src="../../dist/img/credit/visa.png" alt="Visa">
                <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                <img src="../../dist/img/credit/american-express.png" alt="American Express">
                <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg
                    dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                </p>
            </div>
            <!-- /.col -->
            <div class="col-xs-6">
                <p class="lead">Amount Due 2/22/2014</p>

                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">Subtotal:</th>
                            <td>{{ $total_amount_products }} EGP</td>
                        </tr>

                        @if ($purchaseOrder->tax_percent)
                            <div class="ttl-amts">
                                <h5>  Tax : {{ $purchaseOrder->tax }} EGP ( by {{ $purchaseOrder->tax_percent }} % on bill ) </h5>
                            </div>
                            <hr />
                            <tr>
                                <th>Tax ({{ $purchaseOrder->tax_percent }} %)</th>
                                <td>{{ $purchaseOrder->tax }} EGP</td>
                            </tr>
                        @endif
                        <tr>
                            <th>Total:</th>
                            <td>{{ $purchaseOrder->invoice_total }} EGP</td>
                        </tr>

                        <tr>
                            <th>Amount Paid:</th>
                            <td>{{ $purchaseOrder->amount_paid }} EGP</td>
                        </tr>

                        <tr>
                            <th>Amount Due:</th>
                            <td>{{ $purchaseOrder->amount_due }} EGP</td>
                        </tr>

                    </table>
                </div>
            </div>
            <!-- /.col -->
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
            $('#purchase_fullOrder').DataTable({
                // dom: 'lBfrtip',// dom: 'B<"clear">lfrtip',
                // // buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
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
                "order": [[ 0, "desc" ]],
                "bLengthChange": false,
            })
        })
    </script>
    <script>
        $('#printInvoice').click(function(){
            Popup($('.invoice')[0].outerHTML);
            function Popup(data)
            {
                window.print();
                return true;
            }
        });
    </script>
@endpush
@endsection
