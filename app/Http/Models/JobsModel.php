<?php


namespace App\Http\Models;


use Illuminate\Support\Facades\DB;

class JobsModel
{
    public function getJobs()
    {
        $result = DB::table('jobs')
            ->join('restaurantjobs','jobs.id','=','restaurantjobs.job_id')
            ->join('restaurants','restaurantjobs.restaurant_id','=','restaurants.id')
//            ->select('*', 'restaurant.id as ID')
            ->paginate(2);
        return $result;
    }
    public function getLatestJobs()
    {
        $result = DB::table('jobs')
            ->join('restaurantjobs','jobs.id','=','restaurantjobs.job_id')
            ->join('restaurants','restaurantjobs.restaurant_id','=','restaurants.id')
            ->take('3')
            ->orderByDesc('added_at')
            ->get();
        return $result;
    }
    public function getNewestJob()
    {
        $result = DB::table('jobs')
            ->join('restaurantjobs','jobs.id','=','restaurantjobs.job_id')
            ->join('restaurants','restaurantjobs.restaurant_id','=','restaurants.id')
            ->take('1')
            ->orderByDesc('added_at')
            ->first();
        return $result;
    }

    public function getSingleJob($id)
    {
        $result = DB::table('jobs')
            ->join('restaurantjobs','jobs.id','=','restaurantjobs.job_id')
            ->join('restaurants','restaurantjobs.restaurant_id','=','restaurants.id')
            ->where('jobs.id','=', $id)
            ->first();
        return $result;
    }

    public function addApplicant($id)
    {
        DB::table('applicants')
            ->insert([
                'id' => null,
                'job_id' => $id,
                'user_id' => session()->get('user')->UID
            ]);
    }
}