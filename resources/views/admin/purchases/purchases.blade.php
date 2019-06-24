@extends('layouts.admin')

@section('title','Admin Purchases')

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
                <div class="products_table">
                    <form action="{{ route('admin.purchases.destroy') }}" method="post">
                        @csrf
                        @method('DELETE')
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Purchases Invoices</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="purchaseInvoices" class="table table-bordered table-hover table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">Select</th>
                                        <th scope="col">Action</th>
                                        <th scope="col">ID</th>
                                        <th scope="col">Invoice Number</th>
                                        <th scope="col">Invoice Date</th>
                                        <th scope="col">Products Count</th>
                                        <th scope="col">Invoice Subtotal</th>
                                        <th scope="col">Tax Percent</th>
                                        <th scope="col">Tax</th>
                                        <th scope="col">Invoice Total</th>
                                        <th scope="col">Payment Method</th>
                                        <th scope="col">Amount Paid</th>
                                        <th scope="col">Amount Due</th>
                                        <th scope="col">Notes</th>
                                        <th scope="col">Agent</th>
                                        <th scope="col">Client</th>
                                        <th scope="col">Related Products</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Updated At</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($all_purchase_orders as $item)
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="id[]" value="{{ $item->id }}">
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.purchases.edit', $item->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                            </td>
                                            <th scope="col">{{ $item->id }}</th>
                                            <td class="bg-warning">{{ $item->invoiceNo }}</td>
                                            <td>{{ $item->invoiceDate }}</td>
                                            <td>{{ $item->purchaseOrderProducts->count() }}</td>
                                            <td>{{ $item->invoice_subtotal }}</td>
                                            <td>{{ $item->tax_percent == NULL ? 0 : $item->tax_percent }}</td>
                                            <td>{{ $item->tax == NULL ? 0 : $item->tax}}</td>
                                            <td class="bg-primary">{{ $item->invoice_total }}</td>
                                            <td>{{ $item->payment_method == 1 ? 'Cash':'Due' }}</td>
                                            <td>{{ $item->amount_paid }}</td>
                                            <td>{{ $item->amount_due }}</td>
                                            <td>{{ $item->notes }}</td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>
                                                <a href="{{ route('admin.clients.show', $item->client->id) }}">{{ $item->client->name }}</a>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.purchases.show', $item->id) }}" class="btn btn-sm btn-warning">Products</a>
                                            </td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>{{ $item->updated_at }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>


                        {{--=====================================--}}

                        <input type="submit" value="DELETE" name="softDelete" class="btn btn-danger">
                    </form>
                </div>
            </div>
        </div>
    </div>
@push('scripts')
    <script>
        $(function () {
            $('#purchaseInvoices').DataTable({
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
                scrollY:        "400vh",
                scrollX:        true,
                scrollCollapse: true,
                paging:         true,
                fixedColumns:   {
                    heightMatch: 'none'
                },
                "autoWidth": false,
                "ordering": true,
                "order": [[ 17, "desc" ]],
            })
        })
    </script>
@endpush
@endsection
