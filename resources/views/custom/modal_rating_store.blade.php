<!-- Modal Rating -->
<div class="modal fade" id="ratingSModal" tabindex="-1" aria-labelledby="ratingSModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header mb-1">
                <h5 class="modal-title" id="ratingSModalLabel">{{__('Rate the Buyer')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">

                <div class="card card-success card-outline">
                    <div class="card-body" id="apiratingBuyer">

                        <!-- Post -->
                        <div class="post">
                            <div>
                                <h5>{{__('Would you recommend the buyer?')}}</h5>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="radioSecond" id="radioSecond1"
                                        value="si" checked>
                                    <label class="form-check-label" for="radioSecond1">
                                        {{__('Yes')}}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="radioSecond" id="radioSecond2"
                                        value="no">
                                    <label class="form-check-label" for="radioSecond2">
                                        No
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="radioSecond" id="radioSecond3"
                                        value="neutro">
                                    <label class="form-check-label" for="radioSecond3">
                                        {{__('Neutral')}}
                                    </label>
                                </div>

                                <h5 class="mt-3">{{__('Give us your opinion about the buyer')}}</h5>

                                <div class="input-group w-75">
                                    <textarea class="form-control" aria-label="With textarea" rows="2"
                                        id="opinion"></textarea>
                                </div>

                                <div class="form-group mt-1 w-75">
                                    <label for="statusC">Status de la Compra</label>
                                    <select class="form-control" id="statusC">
                                        <option value="Finalizada">Finalizada</option>
                                        <option value="Cancelada">Cancelada</option>
                                    </select>
                                </div>

                                <div class="mt-3">
                                    <button class="btn btn-success btn-lg"
                                        v-on:click="RateBuyer()">{{__('Rate')}}</button>
                                </div>

                                <input type="hidden" id="user_id_modal" name="user_id_modal" value="{{$sales[0]->user_id}}">
                                <input type="hidden" id="store_id_modal" name="store_id_modal" value="{{auth()->user()->id}}">
                                <input type="hidden" id="created_sale_modal" name="created_sale_modal" value="{{$sales[0]->created_at}}">
                            </div>

                        </div>
                        <!-- /.post -->

                    </div><!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</div>