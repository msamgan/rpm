<?php

namespace Msamgan\Rpm\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RoleMenu extends Model
{
    protected $guarded = [];

    /**
     * @return BelongsTo
     */
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
