<?php


namespace App\Http\Models;
use Illuminate\Support\Facades\DB;

class SliderModel
{
    public function getHomeSlider()
    {
        $result = DB::table('slider')
            ->get();
        return $result;
    }
}