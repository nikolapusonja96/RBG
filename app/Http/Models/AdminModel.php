<?php


namespace App\Http\Models;
use Illuminate\Support\Facades\DB;

class AdminModel
{
    public $link;
    public $text;
    public $description_slider;
    public $img_slider;
    public $category_name;
    public $slider_type;
    public $kitchen_name;

    public function getDDLMenu()
    {
        $menus = DB::table('adminmenu')
            ->get();
        foreach ($menus as $menu)
        {
            $menu->submenus = DB::table('adminmenu')
                ->where('parent_id','=', $menu->id)
                ->get();
        }
        return $menus;
    }

    public function addCategory()
    {
        DB::table('categories')
            ->insert(
                [
                   "id" => null,
                   "name" => $this->category_name
                ]);
    }

    public function addLink()
    {
        DB::table('menu')
            ->insert(
                [
                    "id" => null,
                    "path" => $this->link,
                    "name" => $this->text
                ]);
    }

    public function addKitchen()
    {
        DB::table('kitchen')
            ->insert(
                [
                    "id" => null,
                    "name" => $this->kitchen_name
                ]);
    }

    public function addSlider()
    {
        if ($this->slider_type == 'big') {
            DB::table('slider')
                ->insert(
                    [
                        "id" => null,
                        "path" => $this->img_slider,
                        "alt" => $this->description_slider,
                        "type" => 'big'
                    ]);
        }
        else{
            DB::table('slider')
                ->insert(
                    [
                        "id" => null,
                        "path" => $this->img_slider,
                        "alt" => $this->description_slider,
                        "type" => 'small'
                    ]);
        }
    }

    public function deleteSlider($id)
    {
        DB::table('slider')
            ->where('id', $id)
            ->delete();
    }

    public function deleteComment($id)
    {
        DB::table('comments')
            ->where('id', $id)
            ->delete();

        DB::table('restaurantcomments')
            ->where('comment_id', $id)
            ->delete();

        DB::table('usercomments')
            ->where('comment_id', $id)
            ->delete();
    }

    public function deleteLink($id)
    {
        DB::table('menu')
            ->where('id', $id)
            ->delete();
    }

    public function deleteKitchen($id)
    {
        DB::table('kitchen')
            ->where('id', $id)
            ->delete();

        DB::table('restaurants')
            ->where('kitchen_id', $id)
            ->update(
                [
                   "kitchen_id" => 999
                ]);
    }
}