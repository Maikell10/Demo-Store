@extends('plantilla.admin')

@section('titulo','Usuario')

@section('contenido')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-success card-outline">
                    <div class="card-body">
                        <h5 class="card-title">Bienvenido Usuario {{ Auth::user()->name }}</h5>
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