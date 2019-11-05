@extends('rpm::layouts.default')

@section('title', 'Roles')

@section('css')
    <link href="{{ asset('Rpm/Assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Roles</h1>
        <p class="mb-4">Listing all the available roles in the system</p>

        <button class="btn btn-primary btn-sm btn-icon-split mb-4" id="add-role-btn" data-toggle="modal"
                data-target="#role-form-modal">
            <span class="icon text-white-50"><i class="fa fa-plus"></i></span>
            <span class="text">Add Role</span>
        </button>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Roles Listing</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="role-table" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                        </tfoot>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    <div class="modal" id="role-form-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="role-form">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Add New Role</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">

                        @csrf
                        <div class="form-group">
                            <label for="name">Name<sup class="text-danger">*</sup></label>
                            <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp"
                                   required
                                   placeholder="Enter role name">
                            <small id="nameHelp" class="form-text text-muted">An unique name for the Role</small>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description"
                                      aria-describedby="nameHelp"
                                      placeholder="Enter description"></textarea>
                            <small id="nameHelp" class="form-text text-muted">An optional description for Role</small>
                        </div>

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm btn-icon-split" id="role-save"
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
@endsection

@section('js')
    <script src="{{ asset('Rpm/Assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('Rpm/Assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('Rpm/Assets/js/role.js') }}"></script>
@endsection
