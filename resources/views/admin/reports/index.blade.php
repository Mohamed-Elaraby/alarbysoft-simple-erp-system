@extends('layouts.admin')

@section('title','Admin Reports')

@section('content')
    <div class="">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Reports</h1>

                <div class="col-sm-3 col-md-3 reportMain" style="background-color: #43a759;">
                    <a href="{{ route('admin.reports.dayBook') }}">
                        <div class="reportSubMain">
                            <div><i class="ion ion-stats-bars fa-5x"></i></div>
                            <div>Day Book</div>
                        </div>
                    </a>
                </div>

                <div class="col-sm-3 col-md-3 reportMain" style="background-color: #c35c5c;">
                    <a href="{{ route('admin.reports.reportDay') }}">
                        <div class="reportSubMain">
                            <div><i class="ion ion-stats-bars fa-5x"></i></div>
                            <div>Reports Of The Day</div>
                        </div>
                    </a>
                </div>

                <div class="col-sm-3 col-md-3 reportMain" style="background-color: #c36c2d;">
                    <a href="{{ route('admin.reports.reportMonth') }}">
                        <div class="reportSubMain">
                            <div><i class="ion ion-stats-bars fa-5x"></i></div>
                            <div>Reports Of The Month</div>
                        </div>
                    </a>
                </div>

                <div class="col-sm-3 col-md-3 reportMain" style="background-color: #894ca9;">
                    <a href="{{ route('admin.reports.reportYear') }}">
                        <div class="reportSubMain">
                            <div><i class="ion ion-stats-bars fa-5x"></i></div>
                            <div>Reports Of The Year</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')

    @endpush
@endsection
