@extends('plantilla.admin')

@section('titulo',__('Products Visits'))

@section('breadcrumb')
<li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('scripts')
<script>
    /* Chart.js Charts */
    $(function () {
        'use strict'

        var ticksStyle = {
            fontColor: '#495057',
            fontStyle: 'bold'
        }

        var mode      = 'index'
        var intersect = true

        

        var $visitorsChart = $('#visits-chart')
        var visitorsChart  = new Chart($visitorsChart, {
            data   : {
            labels  : [(new Date().getDate()-6)+'th', (new Date().getDate()-5)+'th', (new Date().getDate()-4)+'th', (new Date().getDate()-3)+'th', (new Date().getDate()-2)+'th', (new Date().getDate()-1)+'th', new Date().getDate()+'th'],
            datasets: [{
                type                : 'line',
                data                : [
                    {!! json_encode(\App\Visit::whereDate('created_at', \Carbon\Carbon::now()->subDays(6)->toDateString())->get()->count()) !!},  
                    {!! json_encode(\App\Visit::whereDate('created_at', \Carbon\Carbon::now()->subDays(5)->toDateString())->get()->count()) !!},  
                    {!! json_encode(\App\Visit::whereDate('created_at', \Carbon\Carbon::now()->subDays(4)->toDateString())->get()->count()) !!},  
                    {!! json_encode(\App\Visit::whereDate('created_at', \Carbon\Carbon::now()->subDays(3)->toDateString())->get()->count()) !!}, 
                    {!! json_encode(\App\Visit::whereDate('created_at', \Carbon\Carbon::now()->subDays(2)->toDateString())->get()->count()) !!}, 
                    {!! json_encode(\App\Visit::whereDate('created_at', \Carbon\Carbon::now()->subDay()->toDateString())->get()->count()) !!}, 
                    {!! json_encode(\App\Visit::whereDate('created_at', \Carbon\Carbon::now()->toDateString())->get()->count()) !!}
                ],
                backgroundColor     : 'transparent',
                borderColor         : '#007bff',
                pointBorderColor    : '#007bff',
                pointBackgroundColor: '#007bff',
                fill                : false
                // pointHoverBackgroundColor: '#007bff',
                // pointHoverBorderColor    : '#007bff'
            },
                {
                type                : 'line',
                data                : [
                    {!! json_encode(\App\Visit::whereDate('created_at', \Carbon\Carbon::now()->subDays(13)->toDateString())->get()->count()) !!}, 
                    {!! json_encode(\App\Visit::whereDate('created_at', \Carbon\Carbon::now()->subDays(12)->toDateString())->get()->count()) !!}, 
                    {!! json_encode(\App\Visit::whereDate('created_at', \Carbon\Carbon::now()->subDays(11)->toDateString())->get()->count()) !!}, 
                    {!! json_encode(\App\Visit::whereDate('created_at', \Carbon\Carbon::now()->subDays(10)->toDateString())->get()->count()) !!},
                    {!! json_encode(\App\Visit::whereDate('created_at', \Carbon\Carbon::now()->subDays(9)->toDateString())->get()->count()) !!},
                    {!! json_encode(\App\Visit::whereDate('created_at', \Carbon\Carbon::now()->subDays(8)->toDateString())->get()->count()) !!}, 
                    {!! json_encode(\App\Visit::whereDate('created_at', \Carbon\Carbon::now()->subDays(7)->toDateString())->get()->count()) !!}
                    ],
                backgroundColor     : 'tansparent',
                borderColor         : '#ced4da',
                pointBorderColor    : '#ced4da',
                pointBackgroundColor: '#ced4da',
                fill                : false
                // pointHoverBackgroundColor: '#ced4da',
                // pointHoverBorderColor    : '#ced4da'
                }]
            },
            options: {
            maintainAspectRatio: false,
            tooltips           : {
                mode     : mode,
                intersect: intersect
            },
            hover              : {
                mode     : mode,
                intersect: intersect
            },
            legend             : {
                display: false
            },
            scales             : {
                yAxes: [{
                // display: false,
                gridLines: {
                    display      : true,
                    lineWidth    : '4px',
                    color        : 'rgba(0, 0, 0, .2)',
                    zeroLineColor: 'transparent'
                },
                ticks    : $.extend({
                    beginAtZero : true,
                    //suggestedMax: 200
                }, ticksStyle)
                }],
                xAxes: [{
                display  : true,
                gridLines: {
                    display: false
                },
                ticks    : ticksStyle
                }]
            }
            }
        })
    });
</script>
@endsection

@section('contenido')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-success card-outline">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-lg-4 col-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-danger"><i class="far fa-eye"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">{{__('Products Visits')}}</span>
                                        <span class="info-box-number">{{$visits->count()}}</span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                            </div>



                            <div class="col-lg-8 col-12">
                                <div class="card">
                                    <div class="card-header border-0">
                                        <div class="d-flex justify-content-between">
                                            <h3 class="card-title">{{__('Online Store Visits')}}</h3>
                                            <!-- <a href="javascript:void(0);">{{__('View Report')}}</a> -->
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <p class="d-flex flex-column">
                                                <span
                                                    class="text-bold text-lg">{{number_format($visits->count(),0)}}</span>
                                                <span>{{__('Visits Over Time')}}</span>
                                            </p>
                                            <p class="ml-auto d-flex flex-column text-right">
                                                @if ($profit_visits < 0) <span class="text-danger">
                                                    <i class="fas fa-arrow-down"></i>
                                                    {{number_format($profit_visits,2)}}%
                                                    </span>
                                                    @endif
                                                    @if ($profit_visits == 0)
                                                    <span class="text-secondary">
                                                        <i class="fas fa-minus"></i>
                                                        {{number_format($profit_visits,2)}}%
                                                    </span>
                                                    @endif
                                                    @if ($profit_visits > 0)
                                                    <span class="text-success">
                                                        <i class="fas fa-arrow-up"></i>
                                                        {{number_format($profit_visits,2)}}%
                                                    </span>
                                                    @endif
                                                    <span class="text-muted">{{__('Since the last 7 days')}}</span>
                                            </p>
                                        </div>
                                        <!-- /.d-flex -->

                                        <div class="position-relative mb-4">
                                            <canvas id="visits-chart" height="200"></canvas>
                                        </div>

                                        <div class="d-flex flex-row justify-content-end">
                                            <span class="mr-2">
                                                <i class="fas fa-square text-primary"></i>{{__(' Last 7 Days')}}
                                            </span>

                                            <span>
                                                <i class="fas fa-square text-gray"></i>{{__(' Previous 7 Days')}}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>



                    </div>
                </div><!-- /.card -->
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

@endsection