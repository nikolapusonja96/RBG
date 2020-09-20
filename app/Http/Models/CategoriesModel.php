<?php


namespace App\Http\Models;
use Illuminate\Support\Facades\DB;

class CategoriesModel
{
    public function getCategories()
    {
        $result = DB::table('categories')
            ->get();
        return $result;
    }

}