@extends('plantilla.admin')

@section('titulo','Admin')

@section('scripts')
<script>
    /* Chart.js Charts */
    // Sales chart
    var salesChartCanvas = document.getElementById('revenue-chart-canvas').getContext('2d');
    //$('#revenue-chart').get(0).getContext('2d');

    var salesChartData = {
        labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        datasets: [
        {
            label               : 'Digital Goods',
            backgroundColor     : 'rgba(60,141,188,0.9)',
            borderColor         : 'rgba(60,141,188,0.8)',
            pointRadius          : false,
            pointColor          : '#3b8bba',
            pointStrokeColor    : 'rgba(60,141,188,1)',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data                : [28, 48, 40, 19, 86, 27, 90]
        },
        {
            label               : 'Electronics',
            backgroundColor     : 'rgba(210, 214, 222, 1)',
            borderColor         : 'rgba(210, 214, 222, 1)',
            pointRadius         : false,
            pointColor          : 'rgba(210, 214, 222, 1)',
            pointStrokeColor    : '#c1c7d1',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(220,220,220,1)',
            data                : [65, 59, 80, 81, 56, 55, 40]
        },
        ]
    }

    var salesChartOptions = {
        maintainAspectRatio : false,
        responsive : true,
        legend: {
        display: false
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
    var pieChartCanvas = $('#sales-chart-canvas').get(0).getContext('2d')
    var pieData        = {
        labels: [
            'Instore Sales', 
            'Download Sales',
            'Mail-Order Sales', 
        ],
        datasets: [
        {
            data: [30,12,20],
            backgroundColor : ['#f56954', '#00a65a', '#f39c12'],
        }
        ]
    }
    var pieOptions = {
        legend: {
        display: false
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
      labels  : ['JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
      datasets: [
        {
          backgroundColor: '#007bff',
          borderColor    : '#007bff',
          data           : [1000, 2000, 3000, 2500, 2700, 2500, 3000]
        },
        {
          backgroundColor: '#ced4da',
          borderColor    : '#ced4da',
          data           : [700, 1700, 2700, 2000, 1800, 1500, 2000]
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
                        <h5 class="card-title">Bienvenido {{ Auth::user()->name }}</h5>
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
                                    <a href="#" class="small-box-footer">{{__('More info ')}}<i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-3 col-6 hover_zoom_home">
                                <!-- small box -->
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3>{{$user_count}}</h3>

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
                                    <a href="#" class="small-box-footer">{{__('More info ')}}<i
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
                                                <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
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
                                            <canvas id="sales-chart-canvas" height="300"
                                                style="height: 300px;"></canvas>
                                        </div>
                                    </div>
                                </div><!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                            <div class="col-md-4">
                                <!-- Info Boxes Style 2 -->
                                <a href="{{url('admin/product')}}">
                                    <div class="info-box mb-3 bg-warning hover_zoom_home">
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
                                        <span class="info-box-icon"><i class="far fa-comment"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">{{__('Questions')}}</span>
                                            <span class="info-box-number">{{number_format($comments_count,0)}}</span>
                                        </div>
                                        <div class="info-box-content">
                                            <span class="info-box-text">{{__('Answers')}}</span>
                                            <span class="info-box-number">{{number_format($answers_count,0)}}</span>
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
                                                <span class="text-success">
                                                    <i class="fas fa-arrow-up"></i> 33.1%
                                                </span>
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