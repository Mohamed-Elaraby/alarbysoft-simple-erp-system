@extends('layouts.admin')

@section('title','Admin Report Of The Day')

@section('content')
    <div class="">
        <div class="row">
            <div class="col-md-6">
                <div class="container">
                    <div class="col-md-offset-4 col-md-8">
                        <label for="todayDate">Choose Date</label>
                        <input type="text" id="theDay" autocomplete="off" placeholder="Choose Date">
                    </div>

                   {{-- <div class="col-md-offset-4 col-md-8">
                        <label for="todayDate">Choose Year</label>
                        <input type="text" id="theYear" autocomplete="off" placeholder="Choose Date">
                    </div>--}}
                    <h1 class="text-center"> Report Of The Day </h1>

                    <table id="reportOfTheDay" class="table table-bordered table-hover table-striped">
                        <tbody id="reportDay">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $('#theDay').datepicker({
                format: 'yyyy-mm-dd',
            });
        </script>
        <script>
            $( document ).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('#theDay').on('change', function (){
                    var searchDate = $(this).val();

                    // alert(searchDate);
                    $.ajax({
                        url:"{{ route('admin.reports.reportDay.ajax') }}",
                        data: {searchDate: searchDate},
                        type: 'get',
                        success:function(data) {
                            $('#reportDay').empty();
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
                            $('#reportDay').append(html);
                            // $('#reportDay').append(`<tr><td>${data.totalPurchases}</td><td>${data.totalSales}</td><td>${data.salesProfit}</td><td>${data.profitPercent} %</td><td>${data.expenses}</td><td>${data.payments}</td><td>${data.collecting}</td><td>${data.total}</td></tr>`);
                        }
                    });
                });
            });
        </script>
        <script>
            $(function () {
                $('#reportOfTheDay').DataTable({
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
                    // scrollY:        "400vh",
                    // scrollX:        true,
                    // scrollCollapse: true,
                    paging:         true,
                    fixedColumns:   {
                        heightMatch: 'none'
                    },
                    "ordering": true,
                    "order": [[ 0, "desc" ]],
                })
            })
        </script>
    @endpush
@endsection
