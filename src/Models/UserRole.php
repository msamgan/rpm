<?php

namespace Msamgan\Rpm\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserRole extends Model
{
    protected $guarded = [];

    /**
     * @param $user
     * @param $role
     * @return Builder|Model
     */
    public static function addRole($userId, $roleId)
    {
        return UserRole::query()->create([
            'user_id' => $userId,
            'role_id' => $roleId,
        ]);
    }

    /**
     * @return BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
