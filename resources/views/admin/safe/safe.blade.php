@extends('layouts.admin')

@section('title','Admin The Safe')

@section('content')
    <div class="">
        <div class="row">
            <div class="col-md-6">
                <div class="container">
                    <div class="theSafe">
                        @if (session('success'))
                            <div class="alert alert-success text-center">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('warning'))
                            <div class="alert alert-warning text-center">
                                {{ session('warning') }}
                            </div>
                        @endif

                        @if (session('delete'))
                            <div class="alert alert-danger text-center">
                                {{ session('delete') }}
                            </div>
                        @endif
                        <div class="safe_box">
                            <span class="text-center">{{ $theSafe?number_format($theSafe->final_amount, 2):0 }} EGP</span>
                        </div>
                        <a class="btn btn-success btn-lg btn-block" href="{{ route('admin.safe.operations') }}">Cash/Deposit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(function () {
                $('#payments_table').DataTable({
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
