<?php

namespace Msamgan\Rpm\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserRole extends Model
{
    protected $guarded = [];

    /**
     * @param $userId
     * @param $roleId
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
     * @param $userId
     * @param $roleId
     * @return mixed
     */
    public static function removeRole($userId, $roleId)
    {
        return UserRole::query()->where([
            'user_id' => $userId,
            'role_id' => $roleId,
        ])->delete();
    }

    /**
     * @return BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
