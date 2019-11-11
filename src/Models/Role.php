<?php

namespace Msamgan\Rpm\Models;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use msamgan\udvi\HasUuid;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class Role
 * @package Msamgan\Rpm\Models
 */
class Role extends Model
{
    Use HasUuid;

    protected $guarded = [];

    /**
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }

    /**
     * @param $data
     * @return JsonResponse
     * @throws Exception
     */
    public function getList($data): JsonResponse
    {
        return DataTables::eloquent(
            Role::query()
        )->addColumn('action', function (Role $role) {
            return $role->assignPermission() . $role->editRole() . $role->deleteRole();
        })->make(true);
    }

    /**
     * @return string
     */
    private function assignPermission(): string
    {
        return '<a href="' . url('/assign/' . $this->uuid) . '" class="btn btn-warning btn-sm btn-sm btn-icon-split mr-2">
                        <span class="icon text-white-50"><i class="fa fa-plus"></i></span>
                        <span class="text">Assign Permission</span>
                    </a>';
    }

    /**
     * @return string
     */
    private function editRole(): string
    {
        return '<button type="button" class="btn btn-primary btn-sm btn-sm btn-icon-split edit-role" data-id="' . $this->uuid . '">
                        <span class="icon text-white-50"><i class="fa fa-edit"></i></span>
                        <span class="text">Edit</span>
                    </button>';
    }

    /**
     * @return string
     */
    private function deleteRole(): string
    {
        return '<button type="button" class="btn btn-danger btn-sm btn-sm btn-icon-split ml-2 delete-role" data-id="' . $this->uuid . '">
                        <span class="icon text-white-50"><i class="fa fa-trash"></i></span>
                        <span class="text">Delete</span>
                    </button>';
    }

    /**
     * @param $data
     * @return JsonResponse
     */
    public function store($data): JsonResponse
    {
        $validatedData = Validator::make(
            $data, [
                'name' => [
                    'required',
                    'unique:roles',
                    'max:255'
                ]
            ]
        );

        if ($validatedData->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validatedData->errors()->first()
            ]);
        }

        if (Role::query()->create($data)) {
            return response()->json([
                'status' => true
            ]);
        }

        return response()->json([
            'status' => false
        ]);
    }

    /**
     * @param Role $role
     * @param $data
     * @return JsonResponse
     */
    public function updateRole(Role $role, $data): JsonResponse
    {
        $validatedData = Validator::make(
            $data, [
                'name' => [
                    'required',
                    'max:255',
                    Rule::unique('roles')->ignore($role->id)
                ]
            ]
        );

        if ($validatedData->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validatedData->errors()
                    ->first()
            ]);
        }

        if ($role->update($data)) {
            return response()->json([
                'status' => true,
            ]);
        }

        return response()->json([
            'status' => false,
        ]);
    }

    /**
     * @param $uuid
     * @return Role|Builder|Model|object|null
     */
    public function getByUuid($uuid): Role
    {
        return Role::query()
            ->where('uuid', $uuid)
            ->first();
    }
}
