@extends('layouts.admin')

@section('title','Admin Sales Order Details')

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
                @if ($sale_orders)
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Sales Order Number {{ $sale_orders->invoiceNo }} Products Details</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="sale_orders" class="table table-bordered table-hover row-border">
                                <thead>
                                <tr>
                                    <th scope="col">Select</th>
                                    <th scope="col">ID</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Serial</th>
                                    <th scope="col">Product Recall</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($sale_orders->saleOrderProducts as $value)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="id[]" value="{{ $value->id }}">
                                        </td>
                                        <td>{{ $value->id }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->price }}</td>
                                        <td>{{ $value->quantity }}</td>
                                        <td>{{ $value->total }}</td>
                                        <td>{{ $value->serial }}</td>
                                        <td>

                                            <form action="{{ route('admin.sales.destroy') }}" method="post">
                                                @csrf
                                                @method('DELETE')

                                                <p>
                                                    <button class="btn btn-warning" type="button" data-toggle="collapse" data-target="#{{ 'product_'.$value->id }}" aria-expanded="false" aria-controls="{{ 'product_'.$value->id }}">
                                                        RECALL
                                                    </button>
                                                </p>
                                                <div class="collapse" id="{{ 'product_'.$value->id }}">
                                                    <div class="card card-body">
                                                        <input type="hidden" name="id" value="{{ $value->id }}">
                                                        {{--                                    @if ($value->quantity > 1)--}}
                                                        <label class="control-label" for="quantity">quantity</label>
                                                        <input class="form-control" id="quantity" type="text" name="quantity" autocomplete="off"><br>
                                                        {{--                                    @endif--}}


                                                        <label class="control-label" for="safeAmount">Refound Amount To Safe</label>
                                                        <input class="form-control" id="safeAmount" type="text" name="safeAmount" autocomplete="off"><br>
                                                        <label class="control-label" for="orderAmount">Refound Amount To Client Balance</label>
                                                        <input class="form-control" id="orderAmount" type="text" name="orderAmount" autocomplete="off"><br>
                                                        <input type="submit" value="EXECUTE" name="Recall" class="btn btn-danger">
                                                    </div>
                                                </div>

                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
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
                    // "order": [[ 0, "desc" ]],
                })
            })
        </script>
    @endpush
@endsection
