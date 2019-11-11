<?php

namespace Msamgan\Rpm\Models;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use msamgan\udvi\HasUuid;
use Yajra\DataTables\Facades\DataTables;

class Permission extends Model
{
    use HasUuid;

    protected $guarded = [];

    /**
     * @return BelongsTo
     */
    public function permissionGroup()
    {
        return $this->belongsTo(PermissionGroup::class);
    }


    /**
     * @return Builder[]|Collection
     */
    public function getAll()
    {
        return Permission::query()->get();
    }

    /**
     * @param $data
     * @return JsonResponse
     * @throws Exception
     */
    public function getList($data): JsonResponse
    {
        return DataTables::eloquent(
            Permission::query()
        )->addColumn('action', function (Permission $permission) {
            return $permission->editPermission() . $permission->deletePermission();
        })->make(true);
    }

    /**
     * @return string
     */
    private function editPermission(): string
    {
        return '<button type="button" class="btn btn-primary btn-sm btn-sm btn-icon-split edit-permission" data-id="' . $this->uuid . '">
                        <span class="icon text-white-50"><i class="fa fa-edit"></i></span>
                        <span class="text">Edit</span>
                    </button>';
    }

    /**
     * @return string
     */
    private function deletePermission(): string
    {
        return '<button type="button" class="btn btn-danger btn-sm btn-sm btn-icon-split ml-2 delete-permission" data-id="' . $this->uuid . '">
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
                    'unique:permissions',
                    'max:255'
                ],
                'permission_group_id' => [
                    'required',
                ],
                'route_name' => [
                    'required',
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

        if (Permission::query()->create($data)) {
            return response()->json([
                'status' => true
            ]);
        }

        return response()->json([
            'status' => false
        ]);
    }

    /**
     * @param Permission $permission
     * @param $data
     * @return JsonResponse
     */
    public function updatePermission(Permission $permission, $data): JsonResponse
    {
        $validatedData = Validator::make(
            $data, [
                'name' => [
                    'required',
                    'max:255',
                    Rule::unique('permissions')->ignore($permission->id)
                ],
                'permission_group_id' => [
                    'required',
                ],
                'route_name' => [
                    'required',
                    'max:255'
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

        if ($permission->update($data)) {
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
     * @return Permission|Builder|Model|object|null
     */
    public function getByUuid($uuid): Permission
    {
        return Permission::query()
            ->where('uuid', $uuid)
            ->first();
    }
}
