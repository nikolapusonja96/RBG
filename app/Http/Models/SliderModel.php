<?php


namespace App\Http\Models;
use Illuminate\Support\Facades\DB;

class SliderModel
{
    public function getSlider()
    {
        $result = DB::table('slider')
            ->get();
        return $result;
    }

    public function getBigSlider()
    {
        $result = DB::table('slider')
            ->where('type', '=', 'big')
            ->get();
        return $result;
    }

    public function getSmallSlider()
    {
        $result = DB::table('slider')
            ->where('type', '=', 'small')
            ->get();
        return $result;
    }
}