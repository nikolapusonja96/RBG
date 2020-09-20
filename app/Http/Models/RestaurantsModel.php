<?php


namespace App\Http\Models;
use Illuminate\Support\Facades\DB;

class RestaurantsModel
{
    public $newLikes;
    public $restaurantName;
    public $description;
    public $email;
    public $password;
    public $location;
    public $price_delivery;
    public $min_delivery;
    public $time_delivery;
    public $kitchen;
    public $img;
//    public $chbs;

    public function getRestaurants()
    {
        $result = DB::table('restaurants')
//            ->join('restaurantcategories','restaurants.id','=','restaurantcategories.restaurant_id')
//            ->join('categories','restaurantcategories.category_id','=','categories.id')
//            ->select('*','categories.name as name_category', 'restaurants.name as name_restaurant')
//            ->distinct()
            ->paginate(10);
        return $result;
    }
    public function getTopLikedRestaurants()
    {
        $result = DB::table('restaurants')
            ->orderByDesc('likes')
            ->take(2)
            ->get();
        return $result;
    }

// for users like restaurant button
    public function getLikedRestaurant($id) // za logovanje
    {
        $result = DB::table('likes')
            ->join('restaurants', 'likes.restaurant_id','=','restaurants.id')
            ->where([
                "restaurant_id" => $id,
                "user_id" => session()->get('user')->UID
            ])
            ->select('likes.user_id')
            ->first();
        return $result;
    }

    public function getRestaurantLikes($id)
    {
        $result = DB::table('likes')
            ->join('restaurants', 'likes.restaurant_id','=','restaurants.id')
            ->where('restaurant_id', $id)
            ->select('restaurants.likes')
//            ->first() ovo je bilo i onda na blade moramo ->likes na $likes
            ->count('likes.id');
        return $result;
    }

//    public function getMostLikedRestaurants()
//    {
//        $result = DB::table('restaurants')
//            ->join('likes','restaurants.id','=','likes.restaurants_id');
//    }

    public function getLatestRestaurants()
    {
        $result = DB::table('restaurants')
            ->take('3')
            ->orderByDesc('joined_at')
            ->get();
        return $result;
    }
    public function getRestaurantProducts($id)
    {
        $result = DB::table('products')
            ->join('restaurantproducts','products.id','=','restaurantproducts.product_id')
            ->join('restaurants','restaurantproducts.restaurant_id','=','restaurants.id')
            ->where('restaurantproducts.restaurant_id', $id)
            ->select('*', 'products.name as productName','products.description as productDescription')
//            ->get();
            ->paginate(5);
        return $result;
    }
    public function getSingleRestaurant($id)
    {
       return DB::table('restaurants')
            ->where('id', $id)
            ->first();
    }
//   za kategorije         ->join('restaurantcategories','restaurants.id','=','restaurantcategories.restaurant_id')
//            ->join('categories','restaurantcategories.category_id','=','categories.id')

    public function restaurantRegister($chbs)
    {
        $idRestaurant = DB::table('restaurants')
            ->insertGetId([
                'id' => null,
                'name' => $this->restaurantName,
                'description' => $this->description,
                'delivery_cost' => $this->price_delivery,
                'kitchen_id' => $this->kitchen,
                'min_delivery' => $this->min_delivery,
                'time_delivery' => $this->time_delivery,
                'email' => $this->email,
                'password' => md5($this->password),
                'profile_pic' => $this->img, //videti za sliku
                'likes' => 0,
                'location' => $this->location
            ]);
        foreach ($chbs as $category_id) {
            DB::table('restaurantcategories')
                ->insert([
                    'id' => null,
                    'restaurant_id' => $idRestaurant,
                    'category_id' => $category_id,
                ]);
        }
    }

    public function getRestaurantJobs($id)
    {
//        SELECT * FROM jobs j INNER JOIN restaurantjobs rj ON j.id = rj.job_id WHERE rj.restaurant_id = 1
        $result = DB::table('jobs')
            ->join('restaurantjobs','jobs.id','=','restaurantjobs.job_id')
            ->where('restaurantjobs.restaurant_id',$id)
            ->select('jobs.id', 'jobs.title', 'jobs.wage','jobs.added_at')
            ->paginate(5);
        return $result;
    }

    public function getJobsNumber($id)
    {
        $result = DB::table('jobs')
            ->join('restaurantjobs','jobs.id','=','restaurantjobs.job_id')
            ->where('restaurantjobs.restaurant_id',$id)
            ->select('jobs.id', 'jobs.title', 'jobs.wage','jobs.added_at')
            ->count();
        return $result;
    }

    public function getRestaurantComments($id)
    {
//        SELECT c.text, u.first_name, u.last_name, c.time
//FROM comments c
//INNER JOIN restaurantcomments rc
//ON c.id = rc.comment_id
//INNER JOIN usercomments uc
//ON c.id = uc.comment_id
//INNER JOIN users u
//ON uc.user_id = u.id
//WHERE rc.restaurant_id = 1
        $result = DB::table('comments')
            ->join('restaurantcomments','comments.id','=','restaurantcomments.comment_id')
            ->join('usercomments', 'comments.id','=','usercomments.comment_id')
            ->join('users','usercomments.user_id','=','users.id')
            ->where('restaurantcomments.restaurant_id', $id)
            ->orderByDesc('comments.time')
            ->select('comments.text','users.first_name','users.last_name','comments.time')
            ->paginate(5);
        return $result;
    }

    public function getCommentsNumber($id)
    {
        $result = DB::table('comments')
            ->join('restaurantcomments','comments.id','=','restaurantcomments.comment_id')
            ->join('usercomments', 'comments.id','=','usercomments.comment_id')
            ->join('users','usercomments.user_id','=','users.id')
            ->where('restaurantcomments.restaurant_id',$id)
            ->count();
        return $result;
    }

    public function addLike($id)
    {
            DB::table('likes')
                ->insert([
                    "id" => null,
                    "restaurant_id" => $id,
                    "user_id" => session()->get('user')->UID
                ]);
            DB::table('restaurants')
                ->where('id' ,$id)
                ->update([
                    "likes" => $this->newLikes
                ]);
    }

//    public function addLike($id)
//    {
//        DB::transaction(function (){
//           $id_restaurant = DB::table('restaurants')
//               ->insertGetId([
//                   "likes" => +1
//               ]);
//
//           DB::table('likes')
//               ->insert([
//                   "id" => null,
//                "restaurant_id" => $id_restaurant,
//                "user_id" => session()->get('user')->UID
//               ]);
//        });
//    }

//ovako je bilo staro za lajkovanje

//DB::table('likes')
//                ->insert([
//                    "id" => null,
//                    "restaurant_id" => $id,
//                    "user_id" => session()->get('user')->UID
//                ]);











}