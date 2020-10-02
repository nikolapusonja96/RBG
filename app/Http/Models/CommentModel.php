<?php


namespace App\Http\Models;

use Illuminate\Support\Facades\DB;
class CommentModel
{
    public $comment;
    public function addComment($id)
    {
        $id_comment = DB::table('comments')
            ->insertGetId([
                'id' => null,
                'text' => $this->comment
            ]);

        DB::table('restaurantcomments')
            ->insert([
                'id' => null,
                'restaurant_id' => $id,
                'comment_id' => $id_comment
            ]);

        DB::table('usercomments')
            ->insert([
               'id' => null,
               'user_id' => session()->get('user')->UID,
               'comment_id' => $id_comment
            ]);
    }

    public function getAllComments()
    {
        $result = DB::table('comments')
            ->get();
        return $result;
    }
}