<!-- Modal Language -->
<div class="modal fade" id="languageModal" tabindex="-1" aria-labelledby="languageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="languageModalLabel">{{__('Preferred language')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <small>{{__('Select your preferred language.')}}</small>
                <br>
                @if (config('app.locale') == 'es')
                <a class="btn btn-outline-success" href="#">
                    Español - ES
                    <img width="22px" src="{{ asset('asset/images/circled-dot.png') }}"/>
                </a>
                @else
                <a class="btn btn-outline-success" href="{{route('set_language', 'es')}}">
                    Español - ES
                </a>
                @endif
                <br>

                @if (config('app.locale') == 'en')
                <a class="btn btn-outline-success mt-1" href="#">
                    English - EN
                    <img width="22px" src="{{ asset('asset/images/circled-dot.png') }}"/>
                </a>
                @else
                <a class="btn btn-outline-success mt-1" href="{{route('set_language', 'en')}}">
                    English - EN
                </a>
                @endif
            </div>
        </div>
    </div>
</div>