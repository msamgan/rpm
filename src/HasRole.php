<?php

namespace Msamgan\Rpm;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Msamgan\Rpm\Models\Role;
use Msamgan\Rpm\Models\UserRole;

/**
 * Trait HasRole
 */
trait HasRole
{
    /**
     * @return Builder|Model|object|null
     * get the current role of logged in user.
     */
    public function currentRole()
    {
        return UserRole::query()
            ->where('user_id', $this->id)
            ->first();
    }

    /**
     * @param $name
     * @return bool|Builder|Model
     */
    public function addRoleByName($name)
    {
        $role = Role::query()->where('name', $name)->first();
        if ($role) {
            return false;
        }

        return $this->addRole(Auth::id(), $role->id);
    }

    /**
     * @param $userId
     * @param $roleId
     * @return Builder|Model
     */
    private function addRole($userId, $roleId)
    {
        return UserRole::query()->create([
            'user_id' => $userId,
            'role_id' => $roleId
        ]);
    }

    /**
     * @param $roleId
     * @return bool|Builder|Model
     */
    public function addRoleById($roleId)
    {
        $role = Role::query()->find($roleId);
        if ($role) {
            return false;
        }

        return $this->addRole(Auth::id(), $role->id);
    }
}
