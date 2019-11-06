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
    /*public function getRouteKeyName()
    {
        return 'uuid';
    }*/

    /**
     * @param $data
     * @return JsonResponse
     * @throws Exception
     */
    public function getList($data)
    {
        return DataTables::eloquent(
            Role::query()
        )->addColumn('action', function (Role $role) {
            return $role->editRole() . $role->deleteRole();
        })->make(true);
    }

    /**
     * @return string
     */
    private function editRole()
    {
        return '<button type="button" class="btn btn-primary btn-sm btn-sm btn-icon-split edit-role" data-id="' . $this->uuid . '">
                        <span class="icon text-white-50"><i class="fa fa-edit"></i></span>
                        <span class="text">Edit</span>
                    </button>';
    }

    /**
     * @return string
     */
    private function deleteRole()
    {
        return '<button type="button" class="btn btn-danger btn-sm btn-sm btn-icon-split ml-2">
                        <span class="icon text-white-50"><i class="fa fa-trash"></i></span>
                        <span class="text">Delete</span>
                    </button>';
    }

    /**
     * @param $data
     * @return JsonResponse
     */
    public function store($data)
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
    }

    /**
     * @param Role $role
     * @param $data
     * @return JsonResponse
     */
    public function updateRole(Role $role, $data)
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
     * @return Builder|Model|object|null
     */
    public function getByUuid($uuid)
    {
        return Role::query()
            ->where('uuid', $uuid)
            ->first();
    }
}
