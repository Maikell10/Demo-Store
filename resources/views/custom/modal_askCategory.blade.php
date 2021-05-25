<!-- Modal askCategory -->
<div class="modal fade" id="askCategoryModal" tabindex="-1" aria-labelledby="askCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="askCategoryModalLabel">{{__('Request New Category')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.category.addCategory')}}" method="POST">
                    @csrf

                    <div class="card card-success card-outline">
                        <div class="card-header">
                            <h3 class="card-title">{{__('Tell us which main or secondary category you want to add to TuMiniMercado')}}</h3>
                        </div>
                        <div class="card-body">
            
                            <div class="container">
                                <div class="form-group">
                                    <textarea class="form-control" name="descripcion" id="descripcion" cols="30"
                                        rows="5"></textarea>
                                </div>
                            </div>
            
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <input type="submit" value="{{__('Send')}}" class="btn btn-primary btn-block">
                        </div>
                        <!-- /.card-footer-->
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>