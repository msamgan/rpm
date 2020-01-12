<?php

namespace Msamgan\Rpm;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
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
}
