<div class="modal fade" id="modal_eliminar_user" tabindex="-1" role="dialog" aria-labelledby="modal_eliminar_userLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="confirmareliminar">
            <span id="urlbase" hidden>user</span>
            <div class="modal-header">
                <h5 class="modal-title" id="modal_eliminar_userLabel">{{__('Do you want to delete this register?')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <form :action="urlaeliminar" method="POST">
                    @csrf
                    @method('delete')
                    <input type="text" name="userID" id="userID" hidden>
                    <button type="submit" class="btn btn-primary">{{__('Yes')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>