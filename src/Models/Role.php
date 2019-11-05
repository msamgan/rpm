<?php

namespace Msamgan\Rpm\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use msamgan\udvi\HasUuid;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class Role
 * @package Msamgan\Rpm\Models
 */
class Role extends Model
{
    Use HasUuid;

    protected $guarded = [];

    /**
     * @param $data
     * @return JsonResponse
     * @throws Exception
     */
    public function getList($data)
    {
        return DataTables::eloquent(
            Role::query()
        )->addColumn('action', function (Role $role) {
            return '';
        })->make(true);
    }

    /**
     * @param $data
     * @return JsonResponse
     */
    public function store($data)
    {
        if (Role::query()->create($data)) {
            return response()->json([
                'status' => true
            ]);
        }

        return response()->json([
            'status' => false
        ]);
    }
}
