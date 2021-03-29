@extends('plantilla.admin')

@section('titulo',__('Bounce Rate'))

@section('breadcrumb')
<li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('scripts')
<script>

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
                            <div class="col-lg-6 col-6">
                                <!-- small box -->
                                <div class="small-box bg-success">
                                    <div class="inner">
                                        <h3>{{number_format(($sales_canceled_count * 100)/$total_sales_count,2)}}<sup
                                                style="font-size: 20px">%</sup></h3>

                                        <p>{{__('Bounce Rate')}}</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-stats-bars"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="callout callout-success col-lg-6 col-6">
                                <h5>{{__('Bounce Rate')}}</h5>

                                <p>Es el porcentaje de las ordenes canceladas contra las realizadas</p>
                                <p>
                                    Ordenes Canceladas: <font class="font-weight-bold">{{$sales_canceled_count}}</font>
                                    Ordenes Realizadas: <font class="font-weight-bold">{{$total_sales_count}}</font>
                                </p>
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