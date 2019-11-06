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

class PermissionGroup extends Model
{
    Use HasUuid;

    protected $guarded = [];

    /**
     * @param $data
     * @return JsonResponse
     * @throws Exception
     */
    public function getList($data): JsonResponse
    {
        return DataTables::eloquent(
            PermissionGroup::query()
        )->addColumn('action', function (PermissionGroup $permissionGroup) {
            return $permissionGroup->editRole() . $permissionGroup->deleteRole();
        })->make(true);
    }

    /**
     * @return string
     */
    private function editRole(): string
    {
        return '<button type="button" class="btn btn-primary btn-sm btn-sm btn-icon-split edit-permission-group" data-id="' . $this->uuid . '">
                        <span class="icon text-white-50"><i class="fa fa-edit"></i></span>
                        <span class="text">Edit</span>
                    </button>';
    }

    /**
     * @return string
     */
    private function deleteRole(): string
    {
        return '<button type="button" class="btn btn-danger btn-sm btn-sm btn-icon-split ml-2 delete-permission-group" data-id="' . $this->uuid . '">
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
                    'unique:permission_groups',
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

        if (PermissionGroup::query()->create($data)) {
            return response()->json([
                'status' => true
            ]);
        }

        return response()->json([
            'status' => false
        ]);
    }

    /**
     * @param PermissionGroup $permissionGroup
     * @param $data
     * @return JsonResponse
     */
    public function updateRole(PermissionGroup $permissionGroup, $data): JsonResponse
    {
        $validatedData = Validator::make(
            $data, [
                'name' => [
                    'required',
                    'max:255',
                    Rule::unique('permission_groups')
                        ->ignore($permissionGroup->id)
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

        if ($permissionGroup->update($data)) {
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
     * @return PermissionGroup|Builder|Model|object|null
     */
    public function getByUuid($uuid): PermissionGroup
    {
        return PermissionGroup::query()
            ->where('uuid', $uuid)
            ->first();
    }
}
