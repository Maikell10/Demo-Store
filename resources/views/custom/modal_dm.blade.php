<!-- Modal DM -->
<div class="modal fade" id="dmModal" tabindex="-1" aria-labelledby="dmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                @php
                    $cant_dm_f = $cant_dm_new;
                    if($cant_dm_new > 9){
                        $cant_dm_new = '9+';
                        $cant_dm_f = 5;
                    }
                @endphp
                <h5 class="modal-title" id="dmModalLabel">{{$cant_dm_new}} {{__('Unread Messages')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                @for ($i = 0; $i < $cant_dm_f; $i++)
                <a href="{{route('tienda.purchases.show',$direct_m[$i]->date_order)}}" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        @if ($direct_m[$i]->users->social_image() != 'no hay img')
                        <img src="{{$direct_m[$i]->users->social_image()}}" class="img-size-50 mr-3 img-circle elevation-2"
                            alt="User Image" style="height: 50px; width: 50px; object-fit: cover">
                        @else
                        @if (isset($direct_m[$i]->users->image->url))
                        <img src="{{ $direct_m[$i]->users->image->url }}" class="img-size-50 mr-3 img-circle elevation-2"
                            alt="User Image" style="height: 50px; width: 50px; object-fit: cover">
                        @else
                        <img src="{{ asset('adminlte/dist/img/avatardefault.png') }}"
                            class="img-size-50 mr-3 img-circle elevation-2" alt="User Image">
                        @endif
                        @endif
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                {{$direct_m[$i]->users->name}}
                                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">{{\Illuminate\Support\Str::limit($direct_m[$i]->body ?? '',30,' ...')}}</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>{{ \Carbon\Carbon::parse($direct_m[$i]->created_at)->diffForHumans() }}</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                @endfor
            </div>
        </div>
    </div>
</div>