<?php

namespace Msamgan\Rpm\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Msamgan\Rpm\Models\Menu;

class MenuController extends Controller
{
    /**
     * @var Menu
     */
    protected $menu;

    /**
     * MenuController constructor.
     * @param Menu $menu
     */
    public function __construct(Menu $menu)
    {
        $this->menu = $menu;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        return $this->menu
            ->store($request->except('_token'));
    }
}
