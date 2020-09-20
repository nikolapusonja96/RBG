<?php


namespace App\Http\Models;
use Illuminate\Support\Facades\DB;
class MenuModel
{
    public function getMenu()
    {
        $result = DB::table('menu')
            ->get();
        return $result;
    }
}