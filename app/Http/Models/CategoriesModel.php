<?php


namespace App\Http\Models;
use Illuminate\Support\Facades\DB;

class CategoriesModel
{
    public function getCategories()
    {
        $result = DB::table('categories')
            ->get();
        return $result;
    }

    public function getRestaurantCategories($id)
    {
        $result = DB::table('categories as c')
            ->join('restaurantcategories as rc','c.id','=','rc.category_id')
            ->join('restaurants as r','rc.restaurant_id','=','r.id')
            ->where('rc.restaurant_id', $id)
            ->select('c.id as category_id', 'c.name as category_name')
            ->get();
        return $result;
    }

}