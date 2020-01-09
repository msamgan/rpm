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

        /**
         * if remove menu request is there....
         */
        if (isset($data['removeMenu'])) {
            Menu::query()->where('permission_id', $data['permission_id'])->delete();
            Permission::query()->where('id', $data['permission_id'])->update([
                'menu_id' => null
            ]);

            return response()->json([
                'status' => true
            ]);
        }

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

        $menu = Menu::query()->updateOrCreate([
            'permission_id' => $data['permission_id']
        ], [
            'name' => $data['name'],
            'route' => $data['route'],
            'icon' => $data['icon']
        ]);

        if ($menu) {

            Permission::query()
                ->where('id', $data['permission_id'])
                ->update([
                    'menu_id' => $menu->id
            ]);

            return response()->json([
                'status' => true
            ]);
        }

        return response()->json([
            'status' => false
        ]);
    }
}
