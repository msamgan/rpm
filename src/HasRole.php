<?php

namespace Msamgan\Rpm;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
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
}
