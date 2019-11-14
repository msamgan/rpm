@extends('rpm::layouts.default')

@section('title', 'Assign Permission to Role')

@section('css')

@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Assign Permission to Role : {{ $role->name }}</h1>
        <p class="mb-4"></p>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Assign Permission</h6>
            </div>
            <div class="card-body">
                <form id="permission-assign-form" data-role-id="{{ $role->uuid }}">
                    @csrf
                    <div class="row">
                        @foreach($permissions as $key => $group)
                            <div class="col-md-6">
                                <button class="btn btn-primary mb-2" type="button" data-toggle="collapse"
                                        data-target="#collapse-{{ $key }}" aria-expanded="false"
                                        aria-controls="collapse-{{ $key }}">
                                    {{ fetchPermissionGroupById($key)->name }}
                                </button>
                                <div class="collapse mt-2 show" id="collapse-{{ $key }}">
                                    <div class="card card-body">
                                        @foreach($group as $permission)
                                            <div class="row mt-2">
                                                <div class="col-md-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                               value="{{ $permission->id }}"
                                                               @if(in_array($permission->id, $rolePermissions)){{ 'checked' }}@endif
                                                               name="permissions[]"
                                                               id="check-{{ $permission->id }}">
                                                        <label class="form-check-label"
                                                               for="check-{{ $permission->id }}">
                                                            {{ $permission->name }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary btn-sm btn-icon-split">
                                <span class="icon text-white-50"><i class="fa fa-save"></i></span>
                                <span class="text">Assign to {{ $role->name }}</span>
                            </button>
                            <a href="{{ route('rpm.role.list') }}" class="btn btn-warning btn-sm btn-icon-split">
                                <span class="icon text-white-50"><i class="fa fa-arrow-left"></i></span>
                                <span class="text">Back</span>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

@endsection

@section('js')
    <script src="{{ asset('Rpm/Assets/js/assign.js') }}"></script>
@endsection
