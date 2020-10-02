<?php


namespace App\Http\Models;


use Illuminate\Support\Facades\DB;

class JobsModel
{
    public $jobTitle;
    public $wage;
    public $requirements;
    public $description;
    public $offer;

    public function getJobs()
    {
        $result = DB::table('jobs')
            ->join('restaurantjobs','jobs.id','=','restaurantjobs.job_id')
            ->join('restaurants','restaurantjobs.restaurant_id','=','restaurants.id')
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

    public function getUserSingleJob($id)
    {
        $result = DB::table('jobs')
            ->join('restaurantjobs','jobs.id','=','restaurantjobs.job_id')
            ->join('restaurants','restaurantjobs.restaurant_id','=','restaurants.id')
            ->join('applicants','jobs.id','=','applicants.job_id')
            ->where([
                'jobs.id' => $id,
                'applicants.user_id' => session()->get('user')->UID
            ])
            ->first();
        return $result;
    }

    public function getAllRestaurantJobs()
    {
        $result = DB::table('jobs')
            ->join('restaurantjobs','jobs.id','=','restaurantjobs.job_id')
            ->where('restaurantjobs.restaurant_id', session()->get('restaurant')->id)
            ->get();
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

    public function addJob()
    {
        $idJob = DB::table('jobs')
            ->insertGetId([
                'id' => null,
                'title' => $this->jobTitle,
                'wage' => $this->wage,
                'requirements' => $this->requirements,
                'work_description' => $this->description,
                'our_offer' => $this->offer
            ]);

        DB::table('restaurantjobs')
            ->insert([
                'id' => null,
                'job_id' => $idJob,
                'restaurant_id' => session()->get('restaurant')->id
            ]);
    }

    public function updateJob($id)
    {
        DB::table('jobs')
            ->where('id', $id)
            ->update(
                [
                    'wage' => $this->wage
                ]);
    }

    public function deleteJob($id)
    {
        DB::table('jobs')
            ->where('jobs.id', $id)
            ->delete();

        DB::table('restaurantjobs')
            ->where(
                [
                    "job_id" => $id,
                    "restaurant_id" => session()->get('restaurant')->id
                ])
            ->delete();

        DB::table('applicants')
            ->where('job_id', $id)
            ->delete();
    }
}