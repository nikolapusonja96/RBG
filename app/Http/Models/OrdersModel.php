<?php


namespace App\Http\Models;
use Illuminate\Support\Facades\DB;

class OrdersModel
{
    public $firstName;
    public $lastName;
    public $deliveryAddress;
    public $phone;
    public $cart;
    public $idRestaurant;

    public function addOrder()
    {
        DB::table('orders')
            ->insert([
               'id' => null,
               'firstName' => $this->firstName,
               'lastName' => $this->lastName,
               'delivery_address' => $this->deliveryAddress,
               'phone' => $this->phone,
               'cart' => $this->cart,
               'user_id' => session()->get('user')->UID,
               'restaurant_id' => $this->idRestaurant
            ]);
    }
}