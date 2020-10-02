<?php


namespace App\Http\Models;
use Illuminate\Support\Facades\DB;

class KitchensModel
{

    public function getKitchen()
    {
        $result = DB::table('kitchen')
            ->orderByDesc('id')
            ->get();
        return $result;
    }
    public function getRestaurantKitchen($id)
    {
        $result = DB::table('restaurants')
            ->join('kitchen','restaurants.kitchen_id','=', 'kitchen.id')
            ->where('kitchen.id', $id)
            ->select('*','kitchen.id as KID', 'restaurants.id as RID', 'restaurants.name as restaurant_name')
            ->paginate(5);
        return $result;
    }
}