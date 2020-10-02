<?php


namespace App\Http\Controllers;


use App\Http\Models\CategoriesModel;
use App\Http\Models\CommentModel;
use App\Http\Models\KitchensModel;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class UserController extends FrontendController
{
    public function showLoginForm()
    {
        return view('pages.login', $this->data);
    }

    //login as user
    public function login(Request $request)
    {
        $mail = $request->input('email');
        $password = $request->input('password');
        $user = $this->user->getUser($mail, $password);

        if ($user)
        {
            session()->put('user', $user);
        }
        else{
            return redirect()->back()->with('message', 'Pogrešno uneti podaci!');
        }

        if (session()->get('user')->role_id == 1)
        {
            return redirect('/admin');
        }
        if (session()->get('user')->role_id == 2)
        {
            return redirect('/');
        }
    }

    public function showUserProfile()
    {
        $user = $this->user->getUserProfile();
        $ordersNumber = $this->user->getUserOrdersNumber();
        $appliedJobNumber = $this->user->getUserAppliedJobNumber();

        return view('pages.userProfile', $this->data,
            [
                "user" => $user,
                "ordersNumber" => $ordersNumber,
                "jobNumber" => $appliedJobNumber
            ]);
    }

    public function showUserOrders()
    {
//        dd(session()->get('user')->UID);
        $orders = $this->user->getUserOrders();
//        dd($orders);
        $orders->transform(function ($order){
           $order->cart = unserialize($order->cart);
           return $order;
        });

        return view('pages.userOrders', $this->data, ['orders' => $orders]);
    }

    public function showUserLikedRestaurants()
    {
        $this->data['restaurants'] = $this->user->getUserLikedRestaurant();
        $likedNumber = $this->user->getUserLikedRestaurantsNumber();

        return view('pages.userLikedRestaurants', $this->data,
            [
                "likedNumber" => $likedNumber
            ]);
    }
    public function showAppliedJobs()
    {
        $this->data['jobs'] = $this->user->getUserAppliedJobs();
        $appliedJobNumber = $this->user->getUserAppliedJobNumber();

        return view('pages.userJobs', $this->data,
            [
                "jobNumber" => $appliedJobNumber
            ]);
    }

    public function showRestaurantLoginForm()
    {
        return view('pages.restaurant-login', $this->data);
    }

    //login as restaurant
    public function restaurantLogin(Request $req)
    {
        $email = $req->input('emailRestaurant');
        $password = $req->input('passwordRestaurant');

        $restaurant = $this->restaurant->loginRestaurant($email, $password);

        if ($restaurant)
        {
            session()->put('restaurant', $restaurant);

            return redirect('/restaurant-profile');
        }
        else
        {
            return redirect()->back()->with('message', 'Pogrešno uneti podaci');
        }
    }

    public function showRegistrationForm()
    {
        return view('pages.registration', $this->data);
    }

    public function register(\App\Http\Requests\RegistrationRequest $request)
    {
        $this->user->firstName = $request->input('firstName');
        $this->user->lastName = $request->input('lastName');
        $this->user->address = $request->input('address');
        $this->user->mail = $request->input('mail');
        $this->user->password = $request->input('password');
        $this->user->gender = $request->input('gender');

        try{
            $this->user->insert();

            return redirect('/login')->with('success', 'Uspešna registracija, sad se možete ulogovati!');
        }catch (QueryException $e){
            Log::info("Neuspešna registracija!" .$e->getMessage());
            return redirect()->back();
        }
    }

    public function showRegisterRestaurantForm()
    {
        $categories = new CategoriesModel();
        $kitches = new KitchensModel();

        $this->data['kitchens'] = $kitches->getKitchen();
        $this->data['categories'] = $categories->getCategories();
        return view('pages.registrationRestaurant', $this->data);
    }
    public function registerRestaurant(\App\Http\Requests\RestaurantRegistration $req)
    {
        $this->restaurant->restaurantName = $req->input('restaurantName');
        $this->restaurant->description = $req->input('description');
        $this->restaurant->price_delivery = $req->input('deliveryCost');
        $this->restaurant->min_delivery = $req->input('deliveryMinimum');
        $this->restaurant->time_delivery = $req->input('deliveryTime');
        $this->restaurant->email = $req->input('mail');
        $this->restaurant->password = $req->input('password');
        $this->restaurant->location = $req->input('locationRestaurant');

        //ddl
        $this->restaurant->kitchen = $req->input('kitchen');

        $chbs = $req->input('chbProducts');

        //file
        $image = $req->file('picture');
        $tmp_path = $image->getPathName();
        $extension = $image->getClientOriginalExtension();
        $file_name = time() . '.' .$extension;
        $this->restaurant->img = $path = './img/'.$file_name;

        if($image->isValid())
        {
            File::move($tmp_path, $path);
            $this->restaurant->restaurantRegister($chbs);

            return redirect('/login-restaurant')->with('message', 'Uspešno ste registrovali restoran, sada možete pristupiti vašem panelu');
        }
        else{
            return redirect()->back()->with('message', 'Greška!');
        }
    }

    public function addComment(\App\Http\Requests\CommentRequest $r, $id)
    {
        $comments = new CommentModel();
        $comments->comment = $r->input('comment');
        $comments->addComment($id);

        return redirect()->back()->with('message', 'Vaš komentar je uspešno objavljen');
    }

}