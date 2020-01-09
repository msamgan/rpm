<?php

namespace Msamgan\Rpm\Models;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use msamgan\udvi\HasUuid;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Yajra\DataTables\Facades\DataTables;

class Permission extends Model
{
    use HasUuid, HasSlug;

    protected $guarded = [];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    /**
     * @return BelongsTo
     */
    public function permissionGroup()
    {
        return $this->belongsTo(PermissionGroup::class);
    }

    /**
     * @return HasMany
     */
    public function permissionRoutes()
    {
        return $this->hasMany(PermissionRoute::class);
    }

    /**
     * @return BelongsTo
     */
    public function menu()
    {
        return $this->belongsTo(Menu::class);
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
        )->addColumn('group_name', function (Permission $permission) {
            return $permission->permissionGroup->name;
        })->addColumn('route_name', function (Permission $permission) {
            $routeNames = [];
            foreach ($permission->permissionRoutes as $permissionRoute) {
                $routeNames[] = $permissionRoute->route_name;
            }
            return implode('<br>', $routeNames);
        })->addColumn('action', function (Permission $permission) {
            return $permission->getMenu() . $permission->editPermission() . $permission->deletePermission();
        })->rawColumns(['route_name', 'action'])->make(true);
    }

    /**
     * @return string
     */
    private function getMenu(): string
    {
        if (!$this->menu_id) {
            return '<button type="button" class="btn btn-info btn-sm btn-sm btn-icon-split mr-2 permission-menu" data-toggle="modal"
                data-target="#menu-form-modal" data-id="' . $this->uuid . '">
                        <span class="icon text-white-50"><i class="fa fa-list"></i></span>
                        <span class="text">Add Menu</span>
                    </button>';
        }

        return '<button type="button" class="btn btn-success btn-sm btn-sm btn-icon-split mr-2 permission-menu update-menu" data-toggle="modal"
                data-target="#menu-form-modal" data-id="' . $this->uuid . '" data-menu-id=' . $this->menu_id . '>
                        <span class="icon text-white-50"><i class="fa fa-list"></i></span>
                        <span class="text">Update Menu</span>
                    </button>';
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

        $routeNames = $data['route_name'];
        unset($data['route_name']);

        $permission = Permission::query()
            ->create($data);

        if ($permission) {

            foreach ($routeNames as $routeName) {
                PermissionRoute::query()->create([
                    'permission_id' => $permission->id,
                    'route_name' => $routeName
                ]);
            }

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

        $routeNames = $data['route_name'];
        unset($data['route_name']);

        if ($permission->update($data)) {

            PermissionRoute::query()
                ->where('permission_id', $permission->id)
                ->delete();

            foreach ($routeNames as $routeName) {
                PermissionRoute::query()->create([
                    'permission_id' => $permission->id,
                    'route_name' => $routeName
                ]);
            }

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
            ->with(['permissionRoutes'])
            ->first();
    }
}
