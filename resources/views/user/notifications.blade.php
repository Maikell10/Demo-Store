@extends('plantilla.admin')

@section('titulo', __('See All Notifications'))

@section('contenido')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-success card-outline">
                    <div class="card-body">

                        @php
                            $t_notifications = 0;
                        @endphp

                        @if ($notifications[0][0] != 0)
                            @php
                                $t_notifications = $t_notifications + $notifications[0][0];
                            @endphp
                        @endif

                        @if ($notifications[1][0] != 0)
                            @php
                                $t_notifications = $t_notifications + $notifications[1][0];
                            @endphp
                        @endif

                        @if ($t_notifications == 0)
                            <h3 class="text-center">{{__("You Haven't Notifications")}} <i class="fas fa-check-circle text-success"></i></i></h3>
                        @else
                            <h3 class="text-center">{{$t_notifications}} {{__('Notifications')}} <i class="fas fa-exclamation-circle text-warning"></i></i></h3>
                        @endif
                        
                        @if ($notifications[0][0] != 0)
                        <div class="dropdown-divider"></div>
                        <a href="{{route('admin.comment.index')}}" class="dropdown-item">
                            <i class="far fa-comment mr-2"></i> {{$notifications[0][0]}} {{__('New Questions')}}
                            <span class="float-right text-muted ">{{ \Carbon\Carbon::parse($notifications[0][1])->diffForHumans() }}</span>
                        </a>
                        @endif

                        @if ($notifications[1][0] != 0)
                        <div class="dropdown-divider"></div>
                        <a href="{{route('admin.order.index')}}" class="dropdown-item">
                            <i class="fas fa-shopping-bag mr-2"></i> {{$notifications[1][0]}} {{__('New Orders')}}
                            <span class="float-right text-muted ">{{ \Carbon\Carbon::parse($notifications[1][1][0])->diffForHumans() }}</span>
                        </a>
                        @endif
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