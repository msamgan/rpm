<div class="modal" id="menu-form-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="menu-form">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Menu</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    @csrf
                    <div class="form-group">
                        <label for="name">Name<sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control" id="menuName" name="name" aria-describedby="nameHelp"
                               required
                               placeholder="Enter menu name">
                        <small id="nameHelp" class="form-text text-muted">An unique name for the menu</small>
                    </div>
                    <div class="form-group">
                        <label for="route">Route<sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control" id="route" name="route" aria-describedby="routeHelp"
                               required
                               placeholder="Enter menu route">
                        <small id="routeHelp" class="form-text text-muted">An unique route for the menu</small>
                    </div>
                    <div class="form-group">
                        <label for="icon">Icon</label>
                        <input type="text" class="form-control" id="icon" name="icon" aria-describedby="iconHelp"
                               placeholder="Enter menu icon">
                        <small id="iconHelp" class="form-text text-muted">An unique but optional icon for the menu</small>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <input type="hidden" name="permission_uuid" id="permissionId" value="" >
                    <button type="submit" class="btn btn-primary btn-sm btn-icon-split" id="menu-save"
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
