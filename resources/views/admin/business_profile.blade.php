@extends('plantilla.admin')

@section('titulo',__('Configuration'))

@section('breadcrumb')
<li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('scripts')
<!-- InputMask -->
<script src="{{ asset('adminlte/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>
<script>
    $(function () {
        //Money Euro
        $('[data-mask]').inputmask()
    });
    $('#slidConfig>a').addClass('active');
</script>
@endsection

@section('contenido')

<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <div class="card card-success card-outline">
                    <div class="card-body">
                        <h3 class="font-weight-bold text-success">Igrese la Tasa de Cambio Bs x 1 USD $ 💵💰</h3>
                        
                        <div class="row">
                            <div class="col-md-6">
                                
                                <form action="{{route('admin.business-profile.store', $user->id)}}" method="POST">
                                    @csrf
                                    @method('POST')

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="tasaDia" class="col-md-12 col-form-label">Tasa del Día</label>
                
                                            <div class="input-group col-md-12">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text font-weight-bold" id="basic-addon1">Bs.</span>
                                                </div>
                                                <input type="number" class="form-control" id="tasaDia" name="tasaDia" placeholder="Tasa del Día" required>

                                                <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{auth()->user()->id}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-success btn-block">{{__('Save')}}</button>
                                    </div>
                                </form>
                            </div>

                            @if ($store_profile_config != '[]')
                                @if ($store_profile_config->change != null)
                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="tasaDia" class="col-md-12 col-form-label">Última Tasa del Día <font class="text-muted text-sm ml-3">{{ \Carbon\Carbon::parse($store_profile_config->created_change)->diffForHumans() }}</font></label>
                
                                            <div class="input-group col-md-8">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text font-weight-bold" id="basic-addon1">Bs.</span>
                                                </div>
                                                <input type="text" class="form-control" value={{number_format($store_profile_config->change, 2)}} readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <form action="{{route('admin.business-profile.destroy', $user->id)}}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-block">{{__('Delete')}}</button>
                                        </form>
                                    </div>
                                </div>
                                @endif
                            @endif
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card card-success card-outline">
                    <div class="card-body" id="apiProfileStore">

                        @if ($user->verified != 1)
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="font-weight-bold text-danger">{{__('You have not verified your store yet')}} ❗</h3>

                                <p>{{__('If you want to give your customers more security when They make purchases, You need the verified symbol')}} (<img src="{{asset('asset/images/verified-account.png')}}" style="width: 30px" data-toggle="tooltip" data-placement="right" title="{{ __('Verified') }}" />), {{__('which assures the client that')}} <img src="{{asset('asset/images/TituloLogo2.svg')}}" style="width: 120px;margin-top: -5px;" /> {{__('has its documents and is a verified store')}}.</p>
                                
                                <p>{{__('To get your verification with')}} <img src="{{asset('asset/images/TituloLogo2.svg')}}" style="width: 120px;margin-top: -5px;" /> {{__('must send to the email')}} <font class="font-weight-bold text-danger">rrhh@tuminimercado.com</font> {{__('with the subject:')}} <font class="font-weight-bold">{{__('Verify Store')}}</font></p>
                                <ul>
                                    <li class="font-weight-bold">{{__('In case of being a natural person:')}}</li>
                                    <ul>
                                        <li>{{__('Identification document')}}</li>
                                        <li>{{__('EIN')}} <font class="text-muted font-italic">{{__('(Employer Identification Number)')}}</font></li>
                                        <li>{{__('Copy of any service in which the address of your EIN is reflected')}}</li>
                                    </ul>

                                    <li class="font-weight-bold">{{__('In case of being a legal person:')}}</li>
                                    <ul>
                                        <li>{{__('EIN')}} <font class="text-muted font-italic">{{__('(Employer Identification Number)')}}</font> {{__('of the company')}}</li>
                                        <li>{{__('EIN of the legal representative')}}</li>
                                        <li>{{__('Commercial Registry of the company')}}</li>
                                    </ul>
                                </ul>
                                
                            </div>
                        </div>

                        <hr>
                        @endif
                        
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" action="{{ route('profile.updateUser') }}" method="POST"
                                    id="updateUserForm">
                                    @csrf
                                    <h3 class="font-weight-bold">{{__('Basic Data')}}</h3>
                                    <div class="form-group row">
                                        <input type="hidden" name="inputProfile" value="store">

                                        <label for="inputName" class="col-md-12 col-form-label">{{__('Name')}}</label>

                                        <div class="input-group col-md-12">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i
                                                        class="fa fa-user"></i></span>
                                            </div>
                                            <input type="hidden" id="inputNameH" value="{{ Auth::user()->name }}">
                                            <input type="text"
                                                class="form-control @error('inputName') is-invalid @enderror"
                                                id="inputName" name="inputName" placeholder="{{__('Name')}}"
                                                v-model="inputName">


                                            @error('inputName')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="password"
                                            class="col-md-12 col-form-label">{{__('Password')}}</label>

                                        <div class="input-group  col-md-12">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i
                                                        class="fa fa-lock"></i></span>
                                            </div>
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                id="password" name="password" placeholder="{{__('Password')}}">

                                            @error('password')
                                            @foreach ($errors->all() as $error)
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $error }}</strong>
                                            </span>
                                            @endforeach
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password-confirm"
                                            class="col-md-12 col-form-label">{{ __('Confirm Password') }}</label>

                                        <div class="input-group col-md-12">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i
                                                        class="fa fa-lock"></i></span>
                                            </div>
                                            <input id="password-confirm" type="password"
                                                class="form-control @error('password-confirm') is-invalid @enderror"
                                                name="password_confirmation" autocomplete="new-password"
                                                placeholder="{{ __('Confirm Password') }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" v-model="inputCheckbox" id="inputCheckbox"
                                                        @click='setCheck()'>
                                                    {{__('I agree to the')}} <a
                                                        href="{{url('terminos')}}">{{__('Terms and Conditions')}}</a>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <button type="submit" disabled @click='updateUser()' id="btnConfig"
                                                class="btn btn-success btn-block">{{__('Edit')}}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <hr style="border: 1px solid #28a745">

                        <div class="row">
                            <div class="col-md-12">
                                @if ($store_profile_config != '[]')
                                <h3 class="font-weight-bold">{{__('Data of the Store')}}</h3>
                                <form class="form-horizontal" action="{{ route('admin.business-profile.update', auth()->user()->id) }}" method="POST"
                                    id="updateStoreForm">
                                    @method('PUT')
                                @else
                                <h3 class="font-weight-bold">{{__('Tell Us the Data of the Store')}}</h3>
                                <form class="form-horizontal" action="{{ route('admin.business-profile.store') }}" method="POST"
                                    id="updateStoreForm">
                                @endif
                                
                                    @csrf

                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="inputCountry" class="col-form-label">{{__('Country')}}</label>

                                            <div class="input-group">
                                                @if ($city != '0')
                                                    <input type="hidden" id="inputCountryH" value="{{$city->country->id}}">
                                                @else
                                                    <input type="hidden" id="inputCountryH" value="">
                                                @endif
    
                                                <select name="inputCountry" class="country form-control @error('inputCountry') is-invalid @enderror" id="inputCountry" width="100%" v-model="inputCountry">
                                                    <option selected value="">{{__('Select one')}}</option>
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country->id }}">{{ $country->name }}</option> 
                                                    @endforeach
                                                </select>
    
                                                @error('inputCountry')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputState" class="col-form-label">{{__('State')}}</label>

                                            <div class="input-group">
                                                @if ($city != '0')
                                                    <input type="hidden" id="inputStateH" value="{{$city->id}}">
                                                @else
                                                    <input type="hidden" id="inputStateH" value="">
                                                @endif

                                                <select name="inputState" id="inputState"
                                                    class="form-control select2 @error('inputState') is-invalid @enderror" v-if="cities.length != 0" v-model="inputState">
                                                    <option value="">{{__('Select one')}}</option>
                                                    <option v-for="(city, index) in cities"
                                                        v-bind:value="index+1">
                                                        @{{ city.name }}
                                                    </option>
                                                </select>

                                                <select name="inputState" id="inputState"
                                                    class="form-control select2 @error('inputState') is-invalid @enderror" v-else disabled>
                                                    <option value="">{{__('Select one')}}</option>
                                                </select>
    
                                                @error('inputState')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="inputPhone" class="col-md-12 col-form-label">{{__('Contact')}}</label>

                                        <div class="input-group col-md-12">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i
                                                        class="fa fa-phone"></i></span>
                                            </div>

                                            @if ($store_profile_config != '[]')
                                                <input type="hidden" id="inputPhoneH" value="{{$store_profile_config->contact_phone}}">
                                            @else
                                                <input type="hidden" id="inputPhoneH" value="">
                                            @endif
                                                
                                            <input class="form-control @error('inputPhone') is-invalid @enderror" type="text" name="inputPhone" id="inputPhone" data-inputmask='"mask": "+99 (999) 999-9999"' data-mask v-model="inputPhone">

                                            @error('inputPhone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputFacebook" class="col-md-12 col-form-label">Facebook</label>

                                        <div class="input-group col-md-12">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i
                                                        class="fab fa-facebook-f"></i></span>
                                            </div>

                                            @if ($store_profile_config != '[]')
                                                <input type="hidden" id="inputFacebookH" value="{{$store_profile_config->facebook}}">
                                            @else
                                                <input type="hidden" id="inputFacebookH" value="">
                                            @endif
                                                
                                            <input class="form-control @error('inputFacebook') is-invalid @enderror" type="url" name="inputFacebook" id="inputFacebook" placeholder="Facebook Url" v-model="inputFacebook">

                                            @error('inputFacebook')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputTwitter" class="col-md-12 col-form-label">Twitter</label>

                                        <div class="input-group col-md-12">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i
                                                        class="fab fa-twitter"></i></span>
                                            </div>

                                            @if ($store_profile_config != '[]')
                                                <input type="hidden" id="inputTwitterH" value="{{$store_profile_config->twitter}}">
                                            @else
                                                <input type="hidden" id="inputTwitterH" value="">
                                            @endif
                                                
                                            <input class="form-control @error('inputTwitter') is-invalid @enderror" type="url" name="inputTwitter" id="inputTwitter" placeholder="Twitter Url" v-model="inputTwitter">

                                            @error('inputTwitter')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputInstagram" class="col-md-12 col-form-label">Instagram</label>

                                        <div class="input-group col-md-12">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i
                                                        class="fab fa-instagram"></i></span>
                                            </div>

                                            @if ($store_profile_config != '[]')
                                                <input type="hidden" id="inputInstagramH" value="{{$store_profile_config->instagram}}">
                                            @else
                                                <input type="hidden" id="inputInstagramH" value="">
                                            @endif
                                                
                                            <input class="form-control @error('inputInstagram') is-invalid @enderror" type="url" name="inputInstagram" id="inputInstagram" placeholder="Instagram Url" v-model="inputInstagram">

                                            @error('inputInstagram')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputGoogleMaps" class="col-md-12 col-form-label">Google Maps</label>

                                        <div class="input-group col-md-12">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i
                                                        class="fab fa-google"></i></span>
                                            </div>
                                            
                                            @if ($store_profile_config != '[]')
                                                <input type="hidden" id="inputGoogleMapsH" value="{{$store_profile_config->gmaps}}">
                                            @else
                                                <input type="hidden" id="inputGoogleMapsH" value="">
                                            @endif
                                                
                                            <input class="form-control @error('inputGoogleMaps') is-invalid @enderror" type="url" name="inputGoogleMaps" id="inputGoogleMaps" placeholder="Google Maps Url" v-model="inputGoogleMaps">

                                            @error('inputGoogleMaps')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            @if ($store_profile_config != '[]')
                                                <button type="submit" @click='updateStoreUser()' id="btnStoreUser" class="btn btn-success btn-block">{{__('Edit')}}</button>
                                            @else
                                            <button type="submit" @click='saveStoreUser()' id="btnSaveStoreUser" class="btn bg-yellow btn-block">{{__('Save')}}</button>
                                            @endif
                                        </div>
                                    </div>
                                </form>
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