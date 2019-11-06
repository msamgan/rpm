<div class="modal" id="permission-group-form-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="permission-group-form">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add New Permission Group</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    @csrf
                    <div class="form-group">
                        <label for="name">Name<sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp"
                               required
                               placeholder="Enter permission group name">
                        <small id="nameHelp" class="form-text text-muted">An unique name for the Permission Group</small>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description"
                                  aria-describedby="nameHelp"
                                  placeholder="Enter description"></textarea>
                        <small id="nameHelp" class="form-text text-muted">An optional description for Permission Group</small>
                    </div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm btn-icon-split" id="permission-group-save"
                            data-action="add">
                        <span class="icon text-white-50"><i class="fa fa-save"></i></span>
                        <span class="text">Save</span>
                    </button>
                    <button type="button" class="btn btn-danger btn-sm btn-sm btn-icon-split" data-dismiss="modal">
                        <span class="icon text-white-50"><i class="fa fa-times"></i></span>
                        <span class="text">Close</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
