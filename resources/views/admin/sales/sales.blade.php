@extends('layouts.admin')

@section('title','Admin Sales')

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
                <h3 class="text-center">Sales</h3>
                <div class="products_table">
                    <form action="{{ route('admin.sales.destroy') }}" method="post">
                        @csrf
                        @method('DELETE')
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Sale Orders</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="saleOrders" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Select</th>
                                            <th scope="col">ID</th>
                                            <th scope="col">Invoice</th>
                                            <th scope="col">Products</th>
                                            <th scope="col">Invoice Number</th>
                                            <th scope="col">Invoice Date</th>
                                            <th scope="col">Products Count</th>
                                            <th scope="col">Client</th>
                                            <th scope="col">Invoice Subtotal</th>
                                            <th scope="col">Tax Percent</th>
                                            <th scope="col">Tax</th>
                                            <th scope="col">Invoice Total</th>
                                            <th scope="col">Amount Paid</th>
                                            <th scope="col">Amount Due</th>
                                            <th scope="col">Payment Method</th>
                                            <th scope="col">Agent</th>
                                            <th scope="col">Notes</th>
                                            <th scope="col">Action</th>
                                            <th scope="col">Created At</th>
                                            <th scope="col">Updated At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($all_sales_orders as $item)
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="id[]" value="{{ $item->id }}">
                                            </td>
                                            <th scope="col">{{ $item->id }}</th>
                                            <td>
                                                <a href="{{ route('admin.sales.order', $item->id) }}" class="btn btn-sm btn-success">Show Invoice</a>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.sales.show', $item->id) }}" class="btn btn-sm btn-primary">Products</a>
                                            </td>
                                            <td class="bg-warning">{{ $item->invoiceNo }}</td>
                                            <td>{{ $item->invoiceDate }}</td>
                                            <td>{{ $item->saleOrderProducts->count() }}</td>
                                            <td>{{ $item->client->name }}</td>
                                            <td>{{ $item->invoice_subtotal }}</td>
                                            <td>{{ $item->tax_percent == NULL ? 0 : $item->tax_percent }}</td>
                                            <td>{{ $item->tax == NULL ? 0 : $item->tax}}</td>
                                            <td class="bg-primary">{{ $item->invoice_total }}</td>
                                            <td>{{ $item->amount_paid }}</td>
                                            <td>{{ $item->amount_due }}</td>
                                            <td>{{ $item->payment_method == 1 ? 'Cash':'Due' }}</td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->notes }}</td>
                                            <td>
                                                <a href="{{ route('admin.sales.edit', $item->id) }}" class="btn btn-sm btn-primary">Edit</a>
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
            $('#saleOrders').DataTable({
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
                "ordering": true,
                "order": [[ 1, "desc" ]],
            })
        })
    </script>
@endpush
@endsection
