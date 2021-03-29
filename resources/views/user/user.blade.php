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