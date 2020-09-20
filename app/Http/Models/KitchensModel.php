<?php


namespace App\Http\Models;
use Illuminate\Support\Facades\DB;

class KitchensModel
{

    public function getKitchen()
    {
        $result = DB::table('kitchens')
            ->get();
        return $result;
    }
    public function getRestaurantKitchen($id)
    {
        $result = DB::table('restaurants')
            ->join('kitchens','restaurants.kitchen_id','=', 'kitchens.id')
            ->where('kitchens.id', $id)
            ->select('*','kitchens.id as KID', 'restaurants.id as RID', 'restaurants.name as restaurant_name')
            ->paginate(5);
        return $result;
    }
}