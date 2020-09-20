<?php


namespace App\Http\Models;
use Illuminate\Support\Facades\DB;

class ProductModel
{

    public function getSingleProduct($id)
    {
        $result = DB::table('products')
            ->where('id', '=', $id)
            ->first();
        return $result;
    }
    public function getCartSingleProduct($id)
    {
        $result = DB::table('products')
            ->join('restaurantproducts','products.id','=','restaurantproducts.product_id')
            ->where('products.id', '=', $id)
            ->first();
        return $result;
    }
    public function getCategoryProducts($idRestaurant, $idCategory)
    {
        $result = DB::table('products')
            ->join('categories','products.category_id','=','categories.id')
            ->join('restaurantproducts','products.id','=','restaurantproducts.product_id')
            ->join('restaurants','restaurantproducts.restaurant_id','=','restaurants.id')
            ->where([
                'products.category_id' => $idCategory,
                'restaurantproducts.restaurant_id' => $idRestaurant
                    ])
            ->select('*', 'products.name as productName','products.description as productDescription')
            ->paginate(5);
        return $result;
    }
}