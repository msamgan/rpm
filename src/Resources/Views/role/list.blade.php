@extends('rpm::layouts.default')

@section('title', 'Roles')

@section('css')
    <link href="{{ asset('Rpm/Assets/defaults/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
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

        @include('rpm::role.table')

    </div>
    <!-- /.container-fluid -->

    @include('rpm::role.form')

@endsection

@section('js')
    <script src="{{ asset('Rpm/Assets/defaults/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('Rpm/Assets/defaults/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('Rpm/Assets/js/role.js') }}"></script>
@endsection
