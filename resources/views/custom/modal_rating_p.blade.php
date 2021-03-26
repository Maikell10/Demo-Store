<!-- Modal Rating -->
<div class="modal fade" id="ratingPModal" tabindex="-1" aria-labelledby="ratingPModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header mb-1">
                <h5 class="modal-title" id="ratingPModalLabel">{{__('Choose the Seller')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                @foreach ($sales as $sale)
                @php
                    $user_store = App\User::where('id', $sale->store_id)->get();
                @endphp

                @if (\App\RatingStore::where('created_sale', $id)->where('store_user_id', $user_store[0]->id)->get() == '[]')

                <a href="{{url('store/rating_purchases?store_id=' . $sale->store_id . '&created=' . $sale->created_at . '' )}}" class="dropdown-item">
                    <div class="media">
                        @if ($user_store[0]->social_image() != 'no hay img')
                        <img src="{{$user_store[0]->social_image()}}" class="img-size-50 mr-3 img-circle elevation-2"
                            alt="User Image" style="height: 50px; width: 50px; object-fit: cover">
                        @else
                        @if (isset($user_store[0]->image->url))
                        <img src="{{ $user_store[0]->image->url }}" class="img-size-50 mr-3 img-circle elevation-2"
                            alt="User Image" style="height: 50px; width: 50px; object-fit: cover">
                        @else
                        <img src="{{ asset('adminlte/dist/img/avatardefault.png') }}"
                            class="img-size-50 mr-3 img-circle elevation-2" alt="User Image">
                        @endif
                        @endif
                        <div class="media-body mt-3">
                            <h3 class="dropdown-item-title">
                                {{$user_store[0]->name}}
                            </h3>
                        </div>
                    </div>
                </a>
                <div class="dropdown-divider"></div>

                @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
