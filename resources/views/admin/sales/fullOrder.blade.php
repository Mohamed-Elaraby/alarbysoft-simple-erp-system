@extends('layouts.admin')

@section('title','Admin Sales Order Details')

@section('content')

@push('links')
    <link rel="stylesheet" href="{{ asset('admin/css/invoiceTemplate.css') }}">
@endpush
    <div class="">
        <div class="row">
            <div class="col-md-12">
                <div id="invoice">

                    <div class="toolbar hidden-print">
                        <div class="text-right">
                            <button id="printInvoice" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
                            <button class="btn btn-info"><i class="fa fa-file-pdf-o"></i> Export as PDF</button>
                        </div>
                        <hr>
                    </div>
                    <div class="invoice overflow-auto">
                        <div style="min-width: 600px">
                            <header>
                                <div class="row">
                                    <div class="col">
                                        <a target="_blank" href="https://lobianijs.com">
                                            <img src="http://lobianijs.com/lobiadmin/version/1.0/ajax/img/logo/lobiadmin-logo-text-64.png" data-holder-rendered="true" />
                                        </a>
                                    </div>
                                    <div class="col company-details">
                                        <h2 class="name">
                                            <a target="_blank" href="#">
                                                <b>A</b>laraby<b>S</b>oft
                                            </a>
                                        </h2>
                                        <div>455 Foggy Heights, AZ 85004, US</div>
                                        <div>(123) 456-789</div>
                                        <div>company@example.com</div>
                                    </div>
                                </div>
                            </header>
                            <main>
                                <div class="row contacts">
                                    <div class="col invoice-to">
                                        <div class="text-gray-light">INVOICE TO:</div>
                                        <h2 class="to">{{ $salesOrder->client->name }}</h2>
                                        <div class="address">796 Silver Harbour, TX 79273, US</div>
                                        <div class="email"><a href="mailto:john@example.com">john@example.com</a></div>
                                    </div>
                                    <div class="col invoice-details">
                                        <h1 class="invoice-id">INVOICE {{ $salesOrder->invoiceNo }}</h1>
                                        <div class="date">Date of Invoice: {{ $salesOrder->invoiceDate }}</div>
                                    </div>
                                </div>
                                <table border="0" cellspacing="0" cellpadding="0">
                                    <thead>
                                    <tr>
                                        <th class="text-left">ID</th>
                                        <th class="text-right">Product</th>
                                        <th class="text-right">price</th>
                                        <th class="text-right">Quantity</th>
                                        <th class="text-right">TOTAL</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($salesOrder->saleOrderProducts as $order)
                                            <tr>
                                                <td class="no">{{ $order->id }}</td>
                                                <td class="text-left">
                                                    <h3>{{ $order->name }}</h3>
                                                </td>
                                                <td class="unit">$ {{ $order->price }} E.G</td>
                                                <td class="qty">{{ $order->quantity }}</td>
                                                <td class="total">$ {{ $order->total }}</td>
                                            </tr>

                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2">SUBTOTAL</td>
                                        <td>{{ $salesOrder->invoice_subtotal }} E.G</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2">TAX 14%</td>
                                        <td>{{ $salesOrder->tax_percent }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2">GRAND TOTAL</td>
                                        <td>{{ $salesOrder->invoice_total }} E.G</td>
                                    </tr>
                                    </tfoot>
                                </table>
                                <div class="thanks">Thank you!</div>
                                <div class="notices">
                                    <div>NOTICE:</div>
                                    <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
                                </div>
                            </main>
                            <footer>
                                Invoice was created on a computer and is valid without the signature and seal.
                            </footer>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@push('scripts')
    <script>
        $(function () {
            $('#sale_orders').DataTable({
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
