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
//        public function getUser($mail, $password)
//    {
//        $result = DB::table('users')
//            ->join('roles','users.role_id','=','roles.id_role')
//            ->where([
//                'mail' => $mail,
//                'password' => md5($password),
//                'role_id' => 2
//            ])
//            ->first();
//        return $result;
//    }
        $result = DB::table('users')
            ->join('roles','users.role_id','=','roles.id')
            ->where(
                [
                    'mail' => $mail,
                    'password' => md5($password)
                ]
            )
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
}