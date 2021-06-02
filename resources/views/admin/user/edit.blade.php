@extends('plantilla.admin')

@section('titulo','Editar Usuario')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('admin.user.index')}}">Usuarios</a></li>
<li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('scripts')
    <!-- InputMask -->
    <script src="{{ asset('adminlte/plugins/moment/moment-with-locales.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}">
    </script>

    <script>
        $(function () {
            $('[data-mask]').inputmask();
            
            //Date range picker
            $('#reservationdate').datetimepicker({
                format: 'DD-MM-YYYY',
                locale: moment.locale('es-us'),
                tooltips: {
                    today: 'Hoy',
                    clear: 'Limpiar Selección',
                    close: 'Cerrar el picker',
                    selectMonth: 'Seleccionar Mes',
                    prevMonth: 'Mes Anterior',
                    nextMonth: 'Mes Siguiente',
                    selectYear: 'Seleccionar Año',
                    prevYear: 'Año Anterior',
                    nextYear: 'Año Siguiente',
                    selectDecade: 'Seleccionar Década',
                    prevDecade: 'Década Anterior',
                    nextDecade: 'Década Siguiente',
                    prevCentury: 'Siglo Anterior',
                    nextCentury: 'Siglo Siguiente',
                    selectDate: 'Seleccionar Fecha'
                },
            });
        });
    </script>
@endsection

@section('contenido')

<!-- /.row -->
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Editar Usuario</h2>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                    title="{{__('Collapse')}}">
                    <i class="fas fa-minus"></i></button>
            </div>
        </div>

        <div class="card-body">
            @include('custom.message')

            <form action="{{ route('admin.user.update',$user->id)}}" method="POST">
                @csrf
                @method('PUT')

                <div class="container">

                    <h3>Data Requerida</h3>

                    <div class="form-group">
                        <input type="text" class="form-control" id="name" placeholder="Nombre" name="name"
                            value="{{ old('name',$user->name)}}">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="email" placeholder="Email" name="email"
                            value="{{ old('email',$user->email)}}">
                    </div>

                    <div class="form-group">
                        <select name="roles" id="roles" class="form-control">
                            @foreach ($roles as $role)
                            <option value="{{$role->id}}" @isset($user->roles[0]->name)
                                @if ($role->name == $user->roles[0]->name)
                                selected
                                @endif
                                @endisset

                                >{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="number">{{__('Date')}}</label>

                        <div class="input-group">
                            <div class="input-group date" id="reservationdate"
                                data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input col-md-4"
                                    data-target="#reservationdate"
                                    data-inputmask-alias="datetime"
                                    data-inputmask-inputformat="dd-mm-yyyy" data-mask id="date_expiration"
                                    name="date_expiration" />
                                <div class="input-group-append" data-target="#reservationdate"
                                    data-toggle="datetimepicker">
                                    <div class="input-group-text"><i
                                            class="far fa-calendar-alt"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <input class="btn btn-success" type="submit" value="Editar">

                    <a href="{{route('admin.user.index')}}" class="btn btn-danger">Cancelar</a>


                </div>

            </form>


        </div>
    </div>
</div>
@endsection