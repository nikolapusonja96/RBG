<?php


namespace App\Http\Controllers;


use App\Http\Models\CartModel;
use App\Http\Models\JobsModel;
use App\Http\Models\MenuModel;
use App\Http\Models\ProductModel;
use App\Http\Models\RestaurantsModel;
use App\Http\Models\UserModel;

abstract class BaseController
{
    protected $data = [];
    protected $job;
    protected $restaurant;
    protected $product;
    protected $user;
//    protected $cart;

    public function __construct()
    {
        $menus = new MenuModel();
        $this->data['menus'] = $menus->getMenu();

        $this->product = new ProductModel();
        $this->restaurant = new RestaurantsModel();
        $this->job = new JobsModel();
        $this->user = new UserModel();
//        $this->cart = new CartModel();
    }
}