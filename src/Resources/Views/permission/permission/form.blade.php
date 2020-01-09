<div class="modal" id="permission-form-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="permission-form">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add New Permission</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="permissionGroup">Permission Group<sup class="text-danger">*</sup></label>
                                <select class="form-control" id="permissionGroup" name="permission_group_id" required>
                                    <option value="">--select--</option>
                                    @foreach($permissionGroups as $permissionGroup)
                                        <option value="{{ $permissionGroup->id }}">{{ $permissionGroup->name }}</option>
                                    @endforeach
                                </select>
                                <small id="nameHelp" class="form-text text-muted">Select a Permission Group</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name<sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control" id="name" name="name"
                                       aria-describedby="nameHelp"
                                       required
                                       placeholder="Enter permission name">
                                <small id="nameHelp" class="form-text text-muted">An unique name for the
                                    Permission</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Route Name<sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control" id="routeName" name="route_name[]"
                                       aria-describedby="nameHelp"
                                       required
                                       placeholder="Name of the Route permission to be applied">
                                <small id="nameHelp" class="form-text text-muted">Name of the Route permission to be applied.</small>
                                <div  id="more-route-name-section" ></div>
                            </div>
                            <small style="float: right; cursor: pointer; color: blue" class="form-text mt-2" id="add-more-route-name" >Add More</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description"
                                          aria-describedby="nameHelp"
                                          placeholder="Enter description"></textarea>
                                <small id="nameHelp" class="form-text text-muted">An optional description for
                                    Permission</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm btn-icon-split" id="permission-save"
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
