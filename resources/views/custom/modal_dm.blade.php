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
            <div class="modal-body p-0 mt-1">
                @if (auth()->user())
                @foreach ($direct_m as $direct_m_und)
                    
                    @if ($direct_m_und['type'] == 'coment')
                    @if ($direct_m_und['body']->answers != '[]')
                    @if ($direct_m_und['body']->answers[0]->status == 'PUBLISHED')
                        @php
                            $user_cond = App\User::where('id',$direct_m_und['body']->answers[0]->user_id)->first();
                            $product_slug = App\Product::select('slug')->where('id',$direct_m_und['body']->answers[0]->product_id)->first();
                        @endphp
                        <a href="{{route('tienda.show-product.show',$product_slug->slug)}}" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                @if ($user_cond->social_image() != 'no hay img')
                                <img src="{{$user_cond->social_image()}}" class="img-size-50 mr-3 img-circle elevation-2"
                                    alt="User Image" style="height: 50px; width: 50px; object-fit: cover">
                                @else
                                @if (isset($user_cond->image->url))
                                <img src="{{ $user_cond->image->url }}" class="img-size-50 mr-3 img-circle elevation-2"
                                    alt="User Image" style="height: 50px; width: 50px; object-fit: cover">
                                @else
                                <img src="{{ asset('adminlte/dist/img/avatardefault.png') }}"
                                    class="img-size-50 mr-3 img-circle elevation-2" alt="User Image">
                                @endif
                                @endif
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        {{$user_cond->name}}
                                        <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm text-muted">Respondió a tu pregunta</p>
                                    <p class="text-sm">{{\Illuminate\Support\Str::limit($direct_m_und['body']->answers[0]->body ?? '',30,' ...')}}</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>{{ \Carbon\Carbon::parse($direct_m_und['body']->answers[0]->created_at)->diffForHumans() }}</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                    @endif
                    @endif
                    @endif
                    
                    @if ($direct_m_und['type'] == 'direct_m')
                        @php
                            $user_cond = App\User::where('id',$direct_m_und['body']->store_user_id)->first();
                        @endphp
                        <a href="{{route('tienda.purchases.show',$direct_m_und['body']->date_order)}}" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                @if ($user_cond->social_image() != 'no hay img')
                                <img src="{{$user_cond->social_image()}}" class="img-size-50 mr-3 img-circle elevation-2"
                                    alt="User Image" style="height: 50px; width: 50px; object-fit: cover">
                                @else
                                @if (isset($user_cond->image->url))
                                <img src="{{ $user_cond->image->url }}" class="img-size-50 mr-3 img-circle elevation-2"
                                    alt="User Image" style="height: 50px; width: 50px; object-fit: cover">
                                @else
                                <img src="{{ asset('adminlte/dist/img/avatardefault.png') }}"
                                    class="img-size-50 mr-3 img-circle elevation-2" alt="User Image">
                                @endif
                                @endif
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        {{$user_cond->name}}
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm text-muted">Te envió un mensaje</p>
                                    <p class="text-sm">{{\Illuminate\Support\Str::limit($direct_m_und['body']->body ?? '',30,' ...')}}</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>{{ \Carbon\Carbon::parse($direct_m_und['body']->created_at)->diffForHumans() }}</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                    @endif
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>