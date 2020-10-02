<?php


namespace App\Http\Controllers;


use App\Http\Models\AdminModel;
use App\Http\Models\CartModel;
use App\Http\Models\JobsModel;
use App\Http\Models\MenuModel;
use App\Http\Models\OrdersModel;
use App\Http\Models\ProductModel;
use App\Http\Models\RestaurantMenuModel;
use App\Http\Models\RestaurantsModel;
use App\Http\Models\UserModel;

abstract class BaseController
{
    protected $data = [];
    protected $job;
    protected $restaurant;
    protected $product;
    protected $user;
    protected $admin;
    protected $order;
//    protected $cart;

    public function __construct()
    {
        $menus = new MenuModel();
        $this->data['menus'] = $menus->getMenu();

        $restaurantMenu = new RestaurantMenuModel();
        $this->data['restaurantMenu'] = $restaurantMenu->getMenu();

        $adminMenu = new AdminModel();
        $this->data['adminMenu'] = $adminMenu->getDDLMenu();

        $this->product = new ProductModel();
        $this->restaurant = new RestaurantsModel();
        $this->job = new JobsModel();
        $this->user = new UserModel();
        $this->admin = new AdminModel();
        $this->order = new OrdersModel();
    }
}