<?php

namespace Msamgan\Rpm;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Msamgan\Rpm\Models\Permission;
use Msamgan\Rpm\Models\Role;
use Msamgan\Rpm\Models\RolePermission;
use Msamgan\Rpm\Models\UserRole;

/**
 * Trait HasRole
 */
trait HasRole
{
    /**
     * @return Builder[]|\Illuminate\Database\Eloquent\Collection|Collection
     */
    public function getRoles()
    {
        $userRoles = UserRole::query()
            ->where('user_id', $this->id)
            ->get();

        return $userRoles->map(function ($item) {
            return $item->role;
        });
    }

    /**
     * @param $roleSlug
     * @return bool
     */
    public function ifActiveRole($roleSlug)
    {
        return UserRole::query()->where([
            'user_id' => $this->id,
            'role_id' => Role::getBySlug($roleSlug)->id,
            'active' => 1,
        ])->first() ? true : false;
    }

    /**
     * @param $roleSlug
     * @return Builder|Model|int
     */
    public function setRole($roleSlug)
    {
        $role = Role::getBySlug($roleSlug);
        UserRole::query()
            ->where('user_id', $this->id)
            ->update([
                'active' => 0
            ]);

        $userRole = UserRole::query()->where([
            'user_id' => $this->id,
            'role_id' => $role->id,
        ])->first();

        if (!$userRole) {
            return UserRole::query()->create([
                'user_id' => $this->id,
                'role_id' => $role->id,
                'active' => 1
            ]);
        }

        return UserRole::query()->where([
            'user_id' => $this->id,
            'role_id' => $role->id,
        ])->update([
            'active' => 1
        ]);
    }

    /**
     * @param $roleSlug
     * @return Builder|Model
     */
    public function addRole($roleSlug)
    {
        return UserRole::addRole(
            $this->id,
            Role::getBySlug($roleSlug)->id
        );
    }

    /**
     * @param $roleSlug
     * @return mixed
     */
    public function removeRole($roleSlug)
    {
        return UserRole::removeRole(
            $this->id,
            Role::getBySlug($roleSlug)->id
        );
    }

    /**
     * @param $permissionSlug
     * @return bool
     */
    public function ifHasPermission($permissionSlug)
    {
        $currentRole = $this->currentRole();
        if (!$currentRole) {
            return false;
        }

        $permission = Permission::getBySlug($permissionSlug);
        if (!$permission) {
            return false;
        }

        return RolePermission::query()->where([
            'role_id' => $currentRole->id,
            'permission_id' => $permission->id,
        ])->first() ? true : false;
    }

    /**
     * @return bool|mixed
     */
    public function currentRole()
    {
        $userRole = UserRole::query()
            ->where('user_id', $this->id)
            ->where('active', 1)
            ->first();

        if (!$userRole) {
            return false;
        }

        return $userRole->role;
    }
}
