<?php

namespace Msamgan\Rpm\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class Menu extends Model
{
    protected $guarded = [];

    /**
     * @param $data
     * @return JsonResponse
     */
    public function store($data): JsonResponse
    {
        $data['permission_id'] = app(Permission::class)
            ->getByUuid($data['permission_uuid'])->id;

        $validatedData = Validator::make(
            $data, [
                'permission_id' => [
                    'required',
                ],
                'name' => [
                    'required',
                    'max:255'
                ],
                'route' => [
                    'required',
                    'max:255'
                ],
            ]
        );


        if ($validatedData->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validatedData->errors()->first()
            ]);
        }

        if (Menu::query()->updateOrCreate([
            'permission_id' => $data['permission_id']
        ], [
            'name' => $data['name'],
            'route' => $data['route'],
            'icon' => $data['icon']
        ])) {
            return response()->json([
                'status' => true
            ]);
        }

        return response()->json([
            'status' => false
        ]);
    }
}
