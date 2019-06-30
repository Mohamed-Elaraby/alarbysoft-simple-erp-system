@extends('layouts.admin')

@section('title','Admin Report Of The Year')

@section('content')
    <div class="">
        <div class="row">
            <div class="col-md-6">
                <div class="container">
                    <div class="col-md-offset-4 col-md-8">
                        <label for="todayDate">Choose Date</label>
                        <input type="text" id="theYear" autocomplete="off" placeholder="Choose Date">
                    </div>
                    <h1 class="text-center"> Report Of The Year </h1>

                    <table id="reportOfTheYear" class="table table-bordered table-hover table-striped">
                        <tbody id="reportYear">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $('#theYear').datepicker({
                format: 'yyyy',
                viewMode: "years",
                minViewMode: "years",
            });
        </script>
        <script>
            $( document ).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('#theYear').on('change', function (){
                    var searchDate = $(this).val();

                    // alert(searchDate);
                    $.ajax({
                        url:"{{ route('admin.reports.reportYear.ajax') }}",
                        data: {searchDate: searchDate},
                        type: 'get',
                        success:function(data) {
                            $('#reportYear').empty();
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
                            $('#reportYear').append(html);
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
