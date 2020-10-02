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

    public function getRestaurants()
    {
        $result = DB::table('restaurants')
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
    public function getLikedRestaurant($id)
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
            ->count('likes.id');
        return $result;
    }

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
            ->paginate(5);
        return $result;
    }
    public function getSingleRestaurant($id)
    {
       return DB::table('restaurants')
            ->where('id', $id)
            ->first();
    }

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
                'profile_pic' => $this->img,
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
        $result = DB::table('jobs')
            ->join('restaurantjobs','jobs.id','=','restaurantjobs.job_id')
            ->where('restaurantjobs.restaurant_id',$id)
            ->select('jobs.id', 'jobs.title', 'jobs.wage','jobs.added_at')
            ->orderByDesc('jobs.added_at')
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

    public function getLoggedRestaurant()
    {
        $result = DB::table('restaurants')
            ->where('id', session()->get('restaurant')->id)
            ->first();
        return $result;
    }

    public function loginRestaurant($email, $password)
    {
        $result = DB::table('restaurants')
            ->where(
                [
                    'email' => $email,
                    'password' => md5($password)
                ])
            ->first();
        return $result;
    }
    public function getCheckoutRestaurantInfo()
    {
        $result = DB::table('restaurants')
            ->where('id', session()->get('cart')->idR)
            ->get();
        return $result;
    }

    //restaurantAdmin
    public function getApplicants()
    {
        $result = DB::table('applicants as a')
            ->join('users as u','a.user_id','=','u.id')
            ->join('jobs as j','a.job_id','=','j.id')
            ->join('restaurantjobs as rj','j.id','=','rj.job_id')
            ->join('restaurants as r','rj.restaurant_id','=','r.id')
            ->where('r.id',session()->get('restaurant')->id)
            ->orderByDesc('u.first_name')
            ->select('a.applied_at','u.first_name','u.last_name','u.mail','j.title','j.added_at')
            ->paginate(3);
        return $result;
    }

    public function getApplicantsNumber()
    {
        $result = DB::table('applicants as a')
            ->join('users as u','a.user_id','=','u.id')
            ->join('jobs as j','a.job_id','=','j.id')
            ->join('restaurantjobs as rj','j.id','=','rj.job_id')
            ->join('restaurants as r','rj.restaurant_id','=','r.id')
            ->where('r.id',session()->get('restaurant')->id)
            ->orderByDesc('u.first_name')
            ->select('a.applied_at','u.first_name','u.last_name','u.mail','j.title','j.added_at')
            ->count('u.id');
        return $result;
    }

    public function getOneJobApplicants($id)
    {
        $result = DB::table('applicants as a')
            ->join('users as u','a.user_id','=','u.id')
            ->join('jobs as j','a.job_id','=','j.id')
            ->join('restaurantjobs as rj','j.id','=','rj.job_id')
            ->join('restaurants as r','rj.restaurant_id','=','r.id')
            ->where(
                [
                    'r.id' => session()->get('restaurant')->id,
                    'j.id' => $id
                ])
            ->orderByDesc('u.first_name')
            ->select('a.applied_at','u.first_name','u.last_name','u.mail','j.title','j.added_at')
            ->paginate(3);
        return $result;
    }
    public function getApplicantsPosition($id)
    {
        $result = DB::table('applicants as a')
            ->join('users as u','a.user_id','=','u.id')
            ->join('jobs as j','a.job_id','=','j.id')
            ->join('restaurantjobs as rj','j.id','=','rj.job_id')
            ->join('restaurants as r','rj.restaurant_id','=','r.id')
            ->where(
                [
                    'r.id' => session()->get('restaurant')->id,
                    'j.id' => $id
                ])
            ->orderByDesc('u.first_name')
            ->select('j.title')
            ->first();
        return $result;
    }

    public function getJobApplicantsNumber($id)
    {
        $result = DB::table('applicants as a')
            ->join('users as u','a.user_id','=','u.id')
            ->join('jobs as j','a.job_id','=','j.id')
            ->join('restaurantjobs as rj','j.id','=','rj.job_id')
            ->join('restaurants as r','rj.restaurant_id','=','r.id')
            ->where(
                [
                    'r.id' => session()->get('restaurant')->id,
                    'j.id' => $id
                ])
            ->orderByDesc('u.first_name')
            ->select('a.applied_at','u.first_name','u.last_name','u.mail','j.title','j.added_at')
            ->count();
        return $result;
    }

    public function getOrders()
    {
        $result = DB::table('orders')
            ->where('restaurant_id', session()->get('restaurant')->id)
            ->orderByDesc('created_at')
            ->paginate(5);
        return $result;
    }

    public function getRestaurantCategories()
    {
        $result = DB::table('categories as c')
            ->join('restaurantcategories as rc','c.id','=','rc.category_id')
            ->join('restaurants as r','rc.restaurant_id','=','r.id')
            ->where('r.id', session()->get('restaurant')->id)
            ->select('c.id', 'c.name')
            ->get();
        return $result;
    }

    public function updateInfo()
    {
        DB::table('restaurants')
            ->where('id', session()->get('restaurant')->id)
            ->update(
                [
                    'name' => $this->restaurantName,
                    'description' => $this->description,
                    'delivery_cost' => $this->price_delivery,
                    'min_delivery' => $this->min_delivery,
                    'time_delivery' => $this->time_delivery,
                    'profile_pic' => $this->img,
                    'location' => $this->location
                ]);
    }

}