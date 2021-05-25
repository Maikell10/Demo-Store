@extends('plantilla.admin')

@section('titulo',__('Clients Administration'))

@section('breadcrumb')
<li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('scripts')
<script>
    $('#slidClients>a').addClass('active');
</script>
@endsection

@section('contenido')

<!-- /.row -->
<div id="confirmareliminar" class="row">
    <!-- applocate for use in javascript -->
    <input type="text" value="{{session('applocate')}}" hidden id="applocate">

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('List of Clients') }}</h3>
            </div>

            <div class="card-body table-responsive">

                @include('custom.message')

                <table class="table table-hover table-bordered" id="tableData">
                    <thead>
                        <tr class="bg-gradient-green text-center">
                            <th scope="col"></th>
                            <th scope="col">{{__('Name')}}</th>
                            <th scope="col">Email</th>
                            <th scope="col">{{__('Purchases')}}</th>
                            <th scope="col">{{__('Questions')}}</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $client)
                        <tr>
                            <td class="align-middle text-center">
                                @if ($client->social_image() != 'no hay img')
                                    <img src="{{$client->social_image()}}" class="img-circle elevation-2" alt="User Image" style="height: 40px; width: 40px; object-fit: cover">
                                    @else
                                    @if (isset($client->image->url))
                                    <img src="{{ $client->image->url }}" class="img-circle elevation-2" alt="User Image" style="height: 40px; width: 40px; object-fit: cover">
                                    @else
                                    <img src="{{ asset('adminlte/dist/img/avatardefault.png') }}"
                                        class="img-circle elevation-2" alt="User Image" style="height: 40px; width: 40px; object-fit: cover">
                                    @endif
                                @endif
                            </td>
                            <td class="align-middle">{{$client->name}}</td>
                            <td class="align-middle">{{$client->email}}</td>
                            <td class="align-middle text-center">{{$sales[$client->id]}}</td>
                            <td class="align-middle text-center">{{$comments[$client->id]}}</td>
                            <td class="align-middle text-center text-nowrap">
                                <a class="hover_zoom mr-2" href="{{route('profile.user',$client->name)}}" data-toggle="tooltip" data-placement="bottom" title="{{ __('See Client') }}"><i class="far fa-eye fa-2x text-primary"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                    <tfoot>
                        <tr class="bg-gradient-secondary text-center">
                            <th scope="col"></th>
                            <th scope="col">{{__('Name')}}</th>
                            <th scope="col">Email</th>
                            <th scope="col">{{__('Purchases')}}</th>
                            <th scope="col">{{__('Questions')}}</th>
                            <th scope="col"></th>
                        </tr>
                    </tfoot>
                </table>

            </div>
        </div>
    </div>
</div>
@endsection