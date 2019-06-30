@extends('layouts.admin')

@section('title','Admin DayBook')

@section('content')
    <div class="">
        <div class="row">
            <div class="col-md-6">
                <div class="container">
                    <div class="col-md-offset-4 col-md-8">
                        <label for="todayDate">Choose Date</label>
                        <input type="text" id="todayDate" data-date-format='yyyy-mm-dd' autocomplete="off" placeholder="Choose Date">
                    </div>
                    <h1 class="text-center" style="margin-top: 40px; margin-bottom: 40px" id="dateForH1"></h1>
                    <div>
                        <table class="table table-striped table-bordered table-hover" id="dayBook">
                            <thead>
                            <tr>
                                <th>Invoice No</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Subtotal</th>
                                <th>Serial</th>
                                <th>Time</th>
                            </tr>
                            </thead>
                            <tbody id="dayBookProducts">

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $("#todayDate").datepicker();

        </script>
        <script>
            $( document ).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('#todayDate').on('change', function () {
                    var dateSearch = $(this).val();
                    var url = "{{ route('admin.reports.dayBook.ajax') }}";
                    // alert(url);
                    $.ajax({
                        url:url,
                        data: {dateSearch: dateSearch},
                        type: 'get',
                        success:function(data) {
                            // $('#dayBookProducts').html();
                            $('#dayBookProducts').empty();
                            document.getElementById('dateForH1').innerHTML = "Day Book [ "+dateSearch+" ]";
                            $.each(data.dayBook, function(index, value){
                                // console.log(value.name);
                                var time = value.created_at.split(" ").pop();
                                var order_id = value.sale_order_id;
                                var myUrl = "{{ route('admin.sales.order', 'order_id') }}";
                                var url = myUrl.replace('order_id', order_id);
                                // alert(m);
                                var serial = value.serial;
                                if (serial == null){
                                    serial = '';
                                }
                                $('#dayBookProducts').append(`<tr><td><a href="`+ url +`">${value.invoiceNo}</a></td><td>${value.name}</td><td>${value.quantity}</td><td>${value.price}EGP</td><td>${value.total}EGP</td><td>`+ serial +`</td><td>`+ time +`</td></tr>`);

                            });
                        }
                    });
                })
            });
        </script>
    @endpush
@endsection
