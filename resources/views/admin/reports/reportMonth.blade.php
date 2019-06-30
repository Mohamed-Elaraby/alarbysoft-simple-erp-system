@extends('layouts.admin')

@section('title','Admin Report Of The Month')

@section('content')
    <div class="">
        <div class="row">
            <div class="col-md-6">
                <div class="container">
                    <div class="col-md-offset-4 col-md-8">
                        <label for="todayDate">Choose Date</label>
                        <input type="text" id="theMonth" autocomplete="off" placeholder="Choose Date">
                    </div>

                   {{-- <div class="col-md-offset-4 col-md-8">
                        <label for="todayDate">Choose Year</label>
                        <input type="text" id="theYear" autocomplete="off" placeholder="Choose Date">
                    </div>--}}
                    <h1 class="text-center"> Report Of The Month </h1>

                    <table id="reportOfTheMonth" class="table table-bordered table-hover table-striped">
                        <tbody id="reportMonth">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $('#theMonth').datepicker({
                format: 'yyyy-mm',
                viewMode: "months",
                minViewMode: "months",
            });
/*            $('#theYear').datepicker({
                format: 'yyyy',
                viewMode: "years",
                minViewMode: "years",
            });*/

        </script>
        <script>
            $( document ).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('#theMonth').on('change', function (){
                    var searchDate = $(this).val();

                    // alert(searchDate);
                    $.ajax({
                        url:"{{ route('admin.reports.reportMonth.ajax') }}",
                        data: {searchDate: searchDate},
                        type: 'get',
                        success:function(data) {
                            $('#reportMonth').empty();
                            html = '<tr>';
                            html += '<th width="20%">Total Purchases</th>';
                            html += `<td>${data.totalPurchases} EGP</td>`;
                            html += '</tr>';
                            html += '<tr>';
                            html += '<th width="20%">Total Sales</th>';
                            html += `<td>${data.totalSales} EGP</td>`;
                            html += '</tr>';
                            html += '<tr>';
                            html += '<th  width="20%">Sales Profit</th>';
                            html += `<td>${data.salesProfit} EGP</td>`;
                            html += '</tr>';
                            html += '<tr>';
                            html += '<th  width="20%">Sales Profit Percent</th>';
                            html += `<td>${data.profitPercent} %</td>`;
                            html += '</tr>';
                            html += '<tr>';
                            html += '<th  width="20%">Expenses</th>';
                            html += `<td>${data.expenses} EGP</td>`;
                            html += '</tr>';
                            html += '<tr>';
                            html += '<th  width="20%">Payments</th>';
                            html += `<td>${data.payments} EGP</td>`;
                            html += '</tr>';
                            html += '<tr>';
                            html += '<th  width="20%">Collecting</th>';
                            html += `<td>${data.collecting} EGP</td>`;
                            html += '</tr>';
                            html += '<tr>';
                            html += '<th  width="20%">Total</th>';
                            html += `<td>${data.total} EGP</td>`;
                            html += '</tr>';
                            $('#reportMonth').append(html);
                            // $('#dayBookProducts').empty();
                            // document.getElementById('dateForH1').innerHTML = "Day Book [ "+dateSearch+" ]";
                            // $.each(data.dayBook, function(index, value){
                            //     // console.log(value.name);
                            //     var serial = value.serial;
                            //     if (serial == null){
                            //         serial = '';
                            //     }
                            //     $('#dayBookProducts').append(`<tr><td>${value.name}</td><td>${value.quantity}</td><td>${value.price}EGP</td><td>${value.total}EGP</td><td>`+ serial +`</td></tr>`);
                            //
                            // });
                        }
                    });
                });

                /*$('#theYear').on('change', function () {

                    var year = $(this).val();
                    alert(year);
                    $.ajax({
                        url:"{{ route('admin.reports.reportMonth.ajax') }}",
                        data: {year: year},
                        type: 'get',
                        success:function(data) {
                            $('#result').html(data);
                            $('#dayBookProducts').empty();
                            document.getElementById('dateForH1').innerHTML = "Day Book [ "+dateSearch+" ]";
                            $.each(data.dayBook, function(index, value){
                                // console.log(value.name);
                                var serial = value.serial;
                                if (serial == null){
                                    serial = '';
                                }
                                $('#dayBookProducts').append(`<tr><td>${value.name}</td><td>${value.quantity}</td><td>${value.price}EGP</td><td>${value.total}EGP</td><td>`+ serial +`</td></tr>`);

                            });
                        }
                    });
                })*/
            });
        </script>
    @endpush
@endsection
