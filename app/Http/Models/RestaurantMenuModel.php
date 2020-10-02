<?php


namespace App\Http\Models;


use Illuminate\Support\Facades\DB;

class RestaurantMenuModel
{
    public function getMenu()
    {
        $menus = DB::table('restaurantmenu')
            ->get();
        foreach ($menus as $menu)
        {
            $menu->submenus = DB::table('restaurantmenu')
                ->where('parent_id','=', $menu->id)
                ->get();
        }
        return $menus;
    }
}