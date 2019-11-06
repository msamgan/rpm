@extends('rpm::layouts.default')

@section('title', 'Permission Groups')

@section('css')
    <link href="{{ asset('Rpm/Assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Permission Group</h1>
        <p class="mb-4">Listing all the available permission groups in the system</p>

        <button class="btn btn-primary btn-sm btn-icon-split mb-4" id="add-permission-group-btn" data-toggle="modal"
                data-target="#permission-group-form-modal">
            <span class="icon text-white-50"><i class="fa fa-plus"></i></span>
            <span class="text">Add Permission Group</span>
        </button>

        @include('rpm::permission.group.table')

    </div>
    <!-- /.container-fluid -->

    @include('rpm::permission.group.form')

@endsection

@section('js')
    <script src="{{ asset('Rpm/Assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('Rpm/Assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('Rpm/Assets/js/permission.group.js') }}"></script>
@endsection
