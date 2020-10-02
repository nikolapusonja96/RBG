<?php


namespace App\Http\Models;
use Illuminate\Support\Facades\DB;

class ProductModel
{
    public $name;
    public $price;
    public $grams;
    public $description;
    public $img;
    public $category;

    public function getAllProducts()
    {
        $result = DB::table('products')
            ->join('categories','products.category_id','=','categories.id')
            ->select('products.*','categories.name as category_name')
            ->get();
        return $result;
    }
    public function getAllRestaurantProducts()
    {
        $result = DB::table('products')
            ->join('categories','products.category_id','=','categories.id')
            ->join('restaurantproducts','products.id','=','restaurantproducts.product_id')
            ->where('restaurantproducts.restaurant_id',session()->get('restaurant')->id)
            ->select('products.*','categories.name as category_name')
            ->get();
        return $result;
    }
    public function getSingleProduct($id)
    {
        $result = DB::table('products')
            ->join('categories','products.category_id','=','categories.id')
            ->where('products.id', '=', $id)
            ->select('products.*', 'categories.name as category_name')
            ->first();
        return $result;
    }
    public function getCartSingleProduct($id)
    {
        $result = DB::table('products')
            ->join('restaurantproducts','products.id','=','restaurantproducts.product_id')
            ->join('restaurants', 'restaurantproducts.restaurant_id', '=','restaurants.id')
            ->where('products.id', '=', $id)
            ->select('*', 'products.id as PID', 'products.name as prod_name', 'products.description as prod_description')
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

    public function insertProduct()
    {
        $idProduct = DB::table('products')
            ->insertGetId([
                'id' => null,
                'name' => $this->name,
                'price' => $this->price,
                'grams' => $this->grams,
                'description' => $this->description,
                'img' => $this->img,
                'category_id' => $this->category,
            ]);
        DB::table('restaurantproducts')
            ->insert([
                'id' => null,
                'product_id' => $idProduct,
                'restaurant_id' => session()->get('restaurant')->id
            ]);
    }

    public function updateProduct($id)
    {
        DB::table('products')
            ->where('products.id', $id)
            ->update(
                [
                    'name' => $this->name,
                    'price' => $this->price,
                    'grams' => $this->grams,
                    'description' => $this->description,
                    'img' => $this->img,
                    'category_id' => $this->category,
                ]);
    }

    public function delete($id)
    {
        DB::table('products')
            ->where('products.id', $id)
            ->delete();
        DB::table('restaurantproducts')
            ->where(
                [
                    "product_id" => $id,
                    "restaurant_id" => session()->get('restaurant')->id
                ])
            ->delete();
    }
}