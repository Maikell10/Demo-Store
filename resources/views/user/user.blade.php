@extends('plantilla.admin')

@section('titulo',__('User'))

@section('contenido')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-success card-outline">
                    <div class="card-body">
                        <h5 class="card-title">{{__('Welcome ')}}<font class="font-weight-bold">{{ Auth::user()->name }}</font></h5>
                        <br>

                        <!-- Small boxes (Stat box) -->
                        <div class="row mt-2">
                            <div class="col-lg-3 col-6 hover_zoom_home">
                                <!-- small box -->
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3>{{$notifications[1][0]}}</h3>

                                        <p>{{__('New Orders')}}</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-bag"></i>
                                    </div>
                                    <a href="{{route('admin.order.index')}}"
                                        class="small-box-footer">{{__('More info ')}}<i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-3 col-6 hover_zoom_home">
                                <!-- small box -->
                                <div class="small-box bg-success">
                                    <div class="inner">
                                        <h3>{{number_format(($sales_canceled_count * 100)/$total_sales_count,2)}}<sup style="font-size: 20px">%</sup></h3>

                                        <p>{{__('Bounce Rate')}}</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-stats-bars"></i>
                                    </div>
                                    <a href="{{route('admin.bounce')}}" class="small-box-footer">{{__('More info ')}}<i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-3 col-6 hover_zoom_home">
                                <!-- small box -->
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3>1</h3>

                                        <p>{{__('User Registrations')}}</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-person-add"></i>
                                    </div>
                                    <a href="{{url('admin/user')}}" class="small-box-footer">{{__('More info ')}}<i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-3 col-6 hover_zoom_home">
                                <!-- small box -->
                                <div class="small-box bg-danger">
                                    <div class="inner">
                                        <h3>{{$visits->count()}}</h3>

                                        <p>{{__('Products Visits')}}</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-pie-graph"></i>
                                    </div>
                                    <a href="{{route('admin.visits')}}" class="small-box-footer">{{__('More info ')}}<i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                        </div>
                        <!-- /.row -->
                        <!-- Main row -->

                        <div class="row">
                            <div class="card col-md-8">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-chart-pie mr-1"></i>
                                        {{__('Sales')}}
                                    </h3>
                                    <div class="card-tools">
                                        <ul class="nav nav-pills ml-auto">
                                            <li class="nav-item">
                                                <a class="nav-link active" href="#revenue-chart"
                                                    data-toggle="tab">Area</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#sales-chart" data-toggle="tab">{{__('Donut')}}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <div class="tab-content p-0">
                                        <!-- Morris chart - Sales -->
                                        <div class="chart tab-pane active" id="revenue-chart"
                                            style="position: relative; height: 300px;">
                                            <canvas id="revenue-chart-canvas" height="300"
                                                style="height: 300px;"></canvas>
                                        </div>
                                        <div class="chart tab-pane" id="sales-chart"
                                            style="position: relative; height: 300px;">
                                            @if ($category_sales == '[]')
                                                <h1 class="text-center mt-5">{{__('No Sales Yet This Month')}} <i class="fas fa-frown-open text-warning"></i></h1>
                                            @else
                                                <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                                            @endif
                                        </div>
                                    </div>
                                </div><!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                            <div class="col-md-4">
                                <!-- Info Boxes Style 2 -->
                                <a href="{{url('admin/product')}}">
                                    <div class="info-box mb-3 bg-warning hover_zoom_home">
                                        <div class="row">
                                            <span class="info-box-icon"><i class="fas fa-tags"></i></span>

                                            <div class="info-box-content">
                                                <span class="info-box-text">{{__('Inventory')}}</span>
                                                <span class="info-box-number">{{number_format($prod_cant,0)}}
                                                    <small>'{{__('Total Units')}}'</small> </span>
                                            </div>

                                            <div class="info-box-content">
                                                <span class="info-box-number">{{number_format(count($products),0)}}
                                                    <small>'{{__('Products')}}'</small> </span>
                                            </div>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                </a>
                                <!-- /.info-box -->
                                <a href="{{route('admin.shopping.index')}}">
                                    <div class="info-box mb-3 bg-success hover_zoom_home">
                                        <span class="info-box-icon"><i class="fas fa-store"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">{{__('Purchases')}}</span>
                                            <span class="info-box-number">{{number_format($purchases_count,0)}}</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                </a>
                                <!-- /.info-box -->
                                <a href="{{route('admin.sale.index')}}">
                                    <div class="info-box mb-3 bg-danger hover_zoom_home">
                                        <span class="info-box-icon"><i class="fas fa-hand-holding-usd"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">{{__('Sales')}}</span>
                                            <span class="info-box-number">{{$sales_count}}</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                </a>
                                <!-- /.info-box -->
                                <a href="{{url('admin/comment')}}">
                                    <div class="info-box mb-3 bg-info hover_zoom_home">
                                        <div class="row">
                                            <span class="info-box-icon"><i class="far fa-comment"></i></span>

                                            <div class="info-box-content">
                                                <span class="info-box-text">{{__('Questions')}}</span>
                                                <span class="info-box-number">{{number_format($comments_count,0)}}</span>
                                            </div>
                                            <div class="info-box-content">
                                                <span class="info-box-text">{{__('Answers')}}</span>
                                                <span class="info-box-number">{{number_format($answers_count,0)}}</span>
                                            </div>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                </a>
                                <!-- /.info-box -->
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
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
                                                <span class="text-bold text-lg">{{number_format($visits->count(),0)}}</span>
                                                <span>{{__('Visits Over Time')}}</span>
                                            </p>
                                            <p class="ml-auto d-flex flex-column text-right">
                                                @if ($profit_visits < 0)
                                                    <span class="text-danger">
                                                        <i class="fas fa-arrow-down"></i> {{number_format($profit_visits,2)}}%
                                                    </span>
                                                @endif
                                                @if ($profit_visits == 0)
                                                    <span class="text-secondary">
                                                        <i class="fas fa-minus"></i> {{number_format($profit_visits,2)}}%
                                                    </span>
                                                @endif
                                                @if ($profit_visits > 0)
                                                    <span class="text-success">
                                                        <i class="fas fa-arrow-up"></i> {{number_format($profit_visits,2)}}%
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

                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header border-0">
                                        <div class="d-flex justify-content-between">
                                            <h3 class="card-title">{{__('Sales')}}</h3>
                                            <!-- <a href="javascript:void(0);">{{__('View Report')}}</a> -->
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <p class="d-flex flex-column">
                                                <span class="text-bold text-lg">${{number_format($total_sale,2)}}</span>
                                                <span>{{__('Sales Over Time')}}</span>
                                            </p>
                                            <p class="ml-auto d-flex flex-column text-right">

                                                @if ($profit_sales < 0)
                                                    <span class="text-danger">
                                                        <i class="fas fa-arrow-down"></i> {{number_format($profit_sales,2)}}%
                                                    </span>
                                                @endif
                                                @if ($profit_sales == 0)
                                                    <span class="text-secondary">
                                                        <i class="fas fa-minus"></i> {{number_format($profit_sales,2)}}%
                                                    </span>
                                                @endif
                                                @if ($profit_sales > 0)
                                                    <span class="text-success">
                                                        <i class="fas fa-arrow-up"></i> {{number_format($profit_sales,2)}}%
                                                    </span>
                                                @endif
                                                <span class="text-muted">{{__('Since last month')}}</span>
                                            </p>
                                        </div>
                                        <!-- /.d-flex -->

                                        <div class="position-relative mb-4">
                                            <canvas id="sales-chart2" height="200"></canvas>
                                        </div>

                                        <div class="d-flex flex-row justify-content-end">
                                            <span class="mr-2">
                                                <i class="fas fa-square text-primary"></i>{{__(' This year')}}
                                            </span>

                                            <span>
                                                <i class="fas fa-square text-gray"></i>{{__(' Last year')}}
                                            </span>
                                        </div>
                                    </div>
                                </div>
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

@section('scripts')
<script>
    //alert(new Date().getDate()-6)
    // Color Random
    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    /* Chart.js Charts */
    // Sales chart

    var months = []
    if (new Date().getMonth() < 7) {
        months = ['ENE','FEB','MAR','ABR','MAY','JUN','JUL']
        if ($("#lang").val() == 'en') {
            months = ['JAN','FEB','MAR','APR','MAY','JUN','JUL']
        }
    } else {
        months = ['JUN','JUL','AGO','SEP','OCT','NOV','DIC']
        if ($("#lang").val() == 'en') {
            months = ['JUN','JUL','AUG','SEP','OCT','NOV','DEC']
        }
    }

    var salesChartCanvas = document.getElementById('revenue-chart-canvas').getContext('2d');
    //$('#revenue-chart').get(0).getContext('2d');

    var salesChartData = {
        labels  : [
            months[0], 
            months[1], 
            months[2], 
            months[3], 
            months[4], 
            months[5], 
            months[6]],
        datasets: [
        {
            label               : new Date().getFullYear(),
            backgroundColor     : 'rgba(60,141,188,0.9)',
            borderColor         : 'rgba(60,141,188,0.8)',
            pointRadius         : 4,
            pointHoverRadius    : 12,
            pointColor          : '#3b8bba',
            pointStrokeColor    : 'rgba(60,141,188,1)',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data                : [
                {!! json_encode($saleCanT[0]) !!}, 
                {!! json_encode($saleCanT[1]) !!}, 
                {!! json_encode($saleCanT[2]) !!}, 
                {!! json_encode($saleCanT[3]) !!}, 
                {!! json_encode($saleCanT[4]) !!}, 
                {!! json_encode($saleCanT[5]) !!}, 
                {!! json_encode($saleCanT[6]) !!}]
        },
        {
            label               : new Date().getFullYear() -1,
            backgroundColor     : 'rgba(210, 214, 222, 1)',
            borderColor         : 'rgba(210, 214, 222, 1)',
            pointRadius         : 4,
            pointHoverRadius    : 12,
            pointColor          : 'rgba(210, 214, 222, 1)',
            pointStrokeColor    : '#c1c7d1',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(220,220,220,1)',
            data                : [
                {!! json_encode($saleCanT_ant[0]) !!}, 
                {!! json_encode($saleCanT_ant[1]) !!}, 
                {!! json_encode($saleCanT_ant[2]) !!}, 
                {!! json_encode($saleCanT_ant[3]) !!}, 
                {!! json_encode($saleCanT_ant[4]) !!}, 
                {!! json_encode($saleCanT_ant[5]) !!}, 
                {!! json_encode($saleCanT_ant[6]) !!}]
        },
        ]
    }

    var salesChartOptions = {
        maintainAspectRatio : false,
        responsive : true,
        legend: {
            display: true,
            onHover: function(e) {
                e.target.style.cursor = 'pointer';
            }
        },
        hover: {
            onHover: function(e) {
                var point = this.getElementAtEvent(e);
                if (point.length) e.target.style.cursor = 'pointer';
                else e.target.style.cursor = 'default';
            }
        },
        scales: {
        xAxes: [{
            gridLines : {
            display : false,
            }
        }],
        yAxes: [{
            gridLines : {
            display : false,
            }
        }]
        }
    }

    // This will get the first returned node in the jQuery collection.
    var salesChart = new Chart(salesChartCanvas, { 
        type: 'line', 
        data: salesChartData, 
        options: salesChartOptions
        }
    )

    // Donut Chart
    var category_sales = {!! json_encode($category_sales) !!}
    if (category_sales != '') {
        var pieChartCanvas = $('#sales-chart-canvas').get(0).getContext('2d')
        var pieData        = {
            labels: [
                <?php foreach($category_sales as $category_sale) { ?>
                    {!! json_encode(\App\Category::findOrFail($category_sale->category_id)->nombre) !!},
                <?php } ?>
            ],
            datasets: [
            {
                data: [
                    <?php for($i=0; $i< $category_sales->count(); $i++) { ?>
                        {!! json_encode($category_sales_cant[$i]) !!},
                    <?php } ?>
                ],
                backgroundColor : [
                    <?php foreach($category_sales as $category_sale) { ?>
                        getRandomColor(),
                    <?php } ?>
                ],
            }
            ],
        }
        var pieOptions = {
            legend: {
            display: false
            },
            hover: {
                onHover: function(e) {
                    var point = this.getElementAtEvent(e);
                    if (point.length) e.target.style.cursor = 'pointer';
                    else e.target.style.cursor = 'default';
                }
            },
            maintainAspectRatio : false,
            responsive : true,
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        var pieChart = new Chart(pieChartCanvas, {
            type: 'doughnut',
            data: pieData,
            options: pieOptions      
        });
    }
    
    $(function () {
        'use strict'

        var ticksStyle = {
            fontColor: '#495057',
            fontStyle: 'bold'
        }

        var mode      = 'index'
        var intersect = true

        var $salesChart = $('#sales-chart2')
        var salesChart  = new Chart($salesChart, {
            type   : 'bar',
            data   : {
            labels  : [
                months[0],
                months[1], 
                months[2], 
                months[3], 
                months[4], 
                months[5], 
                months[6]],
            datasets: [
                {
                backgroundColor: '#007bff',
                borderColor    : '#007bff',
                data           : [
                    {!! json_encode($priceSaleSumT[0]) !!}, 
                    {!! json_encode($priceSaleSumT[1]) !!}, 
                    {!! json_encode($priceSaleSumT[2]) !!}, 
                    {!! json_encode($priceSaleSumT[3]) !!}, 
                    {!! json_encode($priceSaleSumT[4]) !!}, 
                    {!! json_encode($priceSaleSumT[5]) !!}, 
                    {!! json_encode($priceSaleSumT[6]) !!}
                ]
                },
                {
                backgroundColor: '#ced4da',
                borderColor    : '#ced4da',
                data           : [
                    {!! json_encode($priceSaleSumT_ant[0]) !!}, 
                    {!! json_encode($priceSaleSumT_ant[1]) !!}, 
                    {!! json_encode($priceSaleSumT_ant[2]) !!}, 
                    {!! json_encode($priceSaleSumT_ant[3]) !!}, 
                    {!! json_encode($priceSaleSumT_ant[4]) !!}, 
                    {!! json_encode($priceSaleSumT_ant[5]) !!}, 
                    {!! json_encode($priceSaleSumT_ant[6]) !!} 
                ]
                }
            ]
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
            legend: {
                display: false,
            },
            hover: {
                onHover: function(e) {
                    var point = this.getElementAtEvent(e);
                    if (point.length) e.target.style.cursor = 'pointer';
                    else e.target.style.cursor = 'default';
                }
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
                    beginAtZero: true,

                    // Include a dollar sign in the ticks
                    callback: function (value, index, values) {
                    if (value >= 1000) {
                        value /= 1000
                        value += 'k'
                    }
                    return '$' + value
                    }
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

        var $visitorsChart = $('#visits-chart')
        var visitorsChart  = new Chart($visitorsChart, {
            data   : {
            labels  : [
                ({!! json_encode(\Carbon\Carbon::now()->subDays(6)->format('d')) !!})+'th',
                ({!! json_encode(\Carbon\Carbon::now()->subDays(5)->format('d')) !!})+'th',
                ({!! json_encode(\Carbon\Carbon::now()->subDays(4)->format('d')) !!})+'th', 
                ({!! json_encode(\Carbon\Carbon::now()->subDays(3)->format('d')) !!})+'th', 
                ({!! json_encode(\Carbon\Carbon::now()->subDays(2)->format('d')) !!})+'th', 
                ({!! json_encode(\Carbon\Carbon::now()->subDay()->format('d')) !!})+'th', 
                ({!! json_encode(\Carbon\Carbon::now()->format('d')) !!})+'th'
            ],
            datasets: [{
                type                : 'line',
                data                : [
                    {!! json_encode(\App\Visit::join('product_user', 'visits.product_id', '=', 'product_user.product_id')->where('product_user.user_id',Auth::user()->id)->whereDate('visits.created_at', \Carbon\Carbon::now()->subDays(6)->toDateString())->get()->count()) !!},  
                    {!! json_encode(\App\Visit::join('product_user', 'visits.product_id', '=', 'product_user.product_id')->where('product_user.user_id',Auth::user()->id)->whereDate('visits.created_at', \Carbon\Carbon::now()->subDays(5)->toDateString())->get()->count()) !!},  
                    {!! json_encode(\App\Visit::join('product_user', 'visits.product_id', '=', 'product_user.product_id')->where('product_user.user_id',Auth::user()->id)->whereDate('visits.created_at', \Carbon\Carbon::now()->subDays(4)->toDateString())->get()->count()) !!},  
                    {!! json_encode(\App\Visit::join('product_user', 'visits.product_id', '=', 'product_user.product_id')->where('product_user.user_id',Auth::user()->id)->whereDate('visits.created_at', \Carbon\Carbon::now()->subDays(3)->toDateString())->get()->count()) !!}, 
                    {!! json_encode(\App\Visit::join('product_user', 'visits.product_id', '=', 'product_user.product_id')->where('product_user.user_id',Auth::user()->id)->whereDate('visits.created_at', \Carbon\Carbon::now()->subDays(2)->toDateString())->get()->count()) !!}, 
                    {!! json_encode(\App\Visit::join('product_user', 'visits.product_id', '=', 'product_user.product_id')->where('product_user.user_id',Auth::user()->id)->whereDate('visits.created_at', \Carbon\Carbon::now()->subDay()->toDateString())->get()->count()) !!}, 
                    {!! json_encode(\App\Visit::join('product_user', 'visits.product_id', '=', 'product_user.product_id')->where('product_user.user_id',Auth::user()->id)->whereDate('visits.created_at', \Carbon\Carbon::now()->toDateString())->get()->count()) !!}
                ],
                pointRadius         : 5,
                pointHoverRadius    : 8,
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
                    {!! json_encode(\App\Visit::join('product_user', 'visits.product_id', '=', 'product_user.product_id')->where('product_user.user_id',Auth::user()->id)->whereDate('visits.created_at', \Carbon\Carbon::now()->subDays(13)->toDateString())->get()->count()) !!}, 
                    {!! json_encode(\App\Visit::join('product_user', 'visits.product_id', '=', 'product_user.product_id')->where('product_user.user_id',Auth::user()->id)->whereDate('visits.created_at', \Carbon\Carbon::now()->subDays(12)->toDateString())->get()->count()) !!}, 
                    {!! json_encode(\App\Visit::join('product_user', 'visits.product_id', '=', 'product_user.product_id')->where('product_user.user_id',Auth::user()->id)->whereDate('visits.created_at', \Carbon\Carbon::now()->subDays(11)->toDateString())->get()->count()) !!}, 
                    {!! json_encode(\App\Visit::join('product_user', 'visits.product_id', '=', 'product_user.product_id')->where('product_user.user_id',Auth::user()->id)->whereDate('visits.created_at', \Carbon\Carbon::now()->subDays(10)->toDateString())->get()->count()) !!},
                    {!! json_encode(\App\Visit::join('product_user', 'visits.product_id', '=', 'product_user.product_id')->where('product_user.user_id',Auth::user()->id)->whereDate('visits.created_at', \Carbon\Carbon::now()->subDays(9)->toDateString())->get()->count()) !!},
                    {!! json_encode(\App\Visit::join('product_user', 'visits.product_id', '=', 'product_user.product_id')->where('product_user.user_id',Auth::user()->id)->whereDate('visits.created_at', \Carbon\Carbon::now()->subDays(8)->toDateString())->get()->count()) !!}, 
                    {!! json_encode(\App\Visit::join('product_user', 'visits.product_id', '=', 'product_user.product_id')->where('product_user.user_id',Auth::user()->id)->whereDate('visits.created_at', \Carbon\Carbon::now()->subDays(7)->toDateString())->get()->count()) !!}
                    ],
                pointRadius         : 5,
                pointHoverRadius    : 8,
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
            hover: {
                mode     : mode,
                intersect: intersect,
                onHover: function(e) {
                    var point = this.getElementAtEvent(e);
                    if (point.length) e.target.style.cursor = 'pointer';
                    else e.target.style.cursor = 'default';
                }
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