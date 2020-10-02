<?php


namespace App\Http\Models;
use Illuminate\Support\Facades\DB;

class UserModel
{
    public $firstName;
    public $lastName;
    public $mail;
    public $password;
    public $address;
    public $gender;

    public function getUser($mail, $password)
    {
        $result = DB::table('users')
            ->join('roles','users.role_id','=','roles.id')
            ->where(
                [
                    'mail' => $mail,
                    'password' => md5($password)
                ])
            ->select('*', 'users.id as UID')
        ->first();
        return $result;
    }
    public function insert()
    {
        DB::table('users')
            ->insert([
               'id' => null,
                'first_name' => $this->firstName,
                'last_name' => $this->lastName,
                'mail' => $this->mail,
                'password' => md5($this->password),
                'address' => $this->address,
                'gender' => $this->gender,
                'role_id' => 2
            ]);
    }

    public function getUserProfile()
    {
        $result = DB::table('users')
            ->join('roles','users.role_id','=','roles.id')
            ->where('users.id', session()->get('user')->UID)
            ->first();
        return $result;
    }

    public function getUserOrdersNumber()
    {
        $result = DB::table('orders')
            ->join('users','orders.user_id','=','users.id')
            ->where('orders.user_id', session()->get('user')->UID)
            ->count('orders.id');
        return $result;
    }
    public function getUserLikedRestaurantsNumber()
    {
        $result = DB::table('restaurants')
            ->join('likes','restaurants.id','=','likes.restaurant_id')
            ->where('likes.user_id', session()->get('user')->UID)
            ->count('restaurants.id');
        return $result;
    }
    public function getUserAppliedJobs()
    {
        $result = DB::table('jobs')
            ->join('applicants','jobs.id','=','applicants.job_id')
            ->where('applicants.user_id', session()->get('user')->UID)
            ->paginate(3);
        return $result;
    }
    public function getUserAppliedJobNumber()
    {
        $result = DB::table('applicants')
            ->join('users','applicants.user_id','=','users.id')
            ->where('applicants.user_id', session()->get('user')->UID)
            ->count('applicants.id');
        return $result;
    }

    public function getUserOrders()
    {
        $result = DB::table('orders')
            ->where('user_id', session()->get('user')->UID)
            ->paginate(5);
        return $result;
    }
    public function getUserLikedRestaurant()
    {
        $result = DB::table('restaurants')
            ->join('likes','restaurants.id','=','likes.restaurant_id')
            ->where('likes.user_id', session()->get('user')->UID)
            ->paginate(3);
        return $result;
    }

}