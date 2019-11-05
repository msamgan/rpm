<?php

namespace Msamgan\Rpm\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use msamgan\udvi\HasUuid;
use Yajra\DataTables\Facades\DataTables;

class Role extends Model
{
    Use HasUuid;

    /**
     * @param $data
     * @return JsonResponse
     * @throws Exception
     */
    public function getList($data)
    {
        return DataTables::eloquent(
            Role::query()
        )->make(true);
    }
}
