@extends('layouts.admin')

@section('title','Admin Create Serial')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-offset-3 col-sm-6">
            @if (session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif
            <h3 class="text-center"><i class="fa fa-edit"></i> Create Serial</h3>
            <form action="{{ route('admin.serials.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="purchase_order">Purchase Order</label>
                    <select name="purchase_order_id" id="purchase_order" class="form-control">
                        <option value="" disabled selected>Choose Purchase Order</option>
                        @foreach ($purchaseOrders as $order)
                            <option value="{{ $order->id }}">{{ $order->invoiceNo }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="product">Products</label>
                    <select name="product_id" id="product" class="form-control">

                    </select>
                </div>

                <table class="table" id="addSerials">
                    <thead>
                        <tr>
                            <th width="2%"><input id="check_all" class="formcontrol" type="checkbox"/></th>
                            <th width="98%">Serial Number</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input class="case" type="checkbox"/></td>
                            <td><input type="text" name="data[0][serial]" id="serial_1" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>
                        </tr>
                    </tbody>
                </table>

                <div class='form-group'>
                    <button id="remove" class="btn btn-danger delete" type="button">- Delete</button>
                    <button id="addMoreRow" class="btn btn-primary addmore" type="button">+ Add More</button>
                </div>

                <div class="form-group">
                    <input type="submit" value="Create" class="btn btn-success btn-block">
                </div>

            </form>
        </div>
    </div>
</div>
@push('scripts')
    <script src="{{ asset('admin/js/addSerials.js') }}"></script>
    <script>
        $( document ).ready(function() {
            $.ajaxSetup({
                headers: {
                    'CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#purchase_order').on('change', function () {
                var order_id = $(this).val();
                var url = "{{ route('serials.getProducts') }}";
                // alert(order_id);
                $.ajax({
                    url:url,
                    data: {order_id: order_id},
                    type: 'get',
                    success:function(data) {
                        if (!data.error){
                            // console.log(data);
                            $('#product').html(data);
                        }
                    }
                });
            })
        });
    </script>
@endpush
@endsection
