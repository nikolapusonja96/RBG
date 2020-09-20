<?php


namespace App\Http\Controllers;


use App\Http\Models\CategoriesModel;
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

    public function login(Request $request)
    {
        $mail = $request->input('email');
        $password = $request->input('password');

        $user = $this->user->getUser($mail, $password);


//        dd($user);

        if ($user)
        {
            session()->put('user', $user);

//            dd($user);
        }
        else{
            return redirect()->back()->with('message', 'Pogrešno uneti podaci!');
        }

        if (session()->get('user')->role_id == 1)
        {
            return redirect('/');
        }
        if (session()->get('user')->role_id == 2)
        {
            return redirect('/');
        }
        if (session()->get('user')->role_id == 3)
        {
            return redirect('/restaurant/profile');
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

//        dd($this->user->firstName);
        try{
            $this->user->insert();

            return redirect('/login')->with('success', 'Uspešna registracija, sad se možete ulogovati!');
        }catch (QueryException $e){
            Log::info("Neuspešna registracija!" .$e->getMessage());
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

        //chb za svaki chb upisati u bazu productsrestaurants
        $chbs = $req->input('chbProducts');

//        dd($chbs);

        //file
        $image = $req->file('picture'); //instanca fajla
//        dd($req->file('picture'));
        $tmp_path = $image->getPathName();
        $extension = $image->getClientOriginalExtension();
        $file_name = time() . '.' .$extension;
        $this->restaurant->img = $path = './img/'.$file_name; //ovo se upisuje

        if($image->isValid())
        {
            File::move($tmp_path, $path);
            $this->restaurant->restaurantRegister($chbs);
            return redirect()->back()->with('message', 'Uspešno ste registrovali restoran, sada možete pristupiti vašem panelu');
        }
        else{
            return redirect()->back()->with('message', 'Greška!');
        }
        //
////        dd($this->user->firstName);
//        try{
//            $this->user->insert();
//
//            return redirect('/login')->with('success', 'Uspešna registracija, sad se možete ulogovati!');
//        }catch (QueryException $e){
//            Log::info("Neuspešna registracija!" .$e->getMessage());
//        }
//        $name = $request->input('productName');
//        $price = $request->input('productPrice');
//        $brand = $request->input('productBrand');
//        $bracelet = $request->input('productBracelet');
//        $braceletColor = $request->input('productBraceletColor');
//        $description = $request->input('descImage');
//        $category = $request->input('productCategory');
//
//        $image = $request->file('productImage');//instanca fajla
//        $tmp_path = $image->getPathName();
//        $extension = $image->getClientOriginalExtension();
//        $file_name = time() . '.' .$extension;
//        $path = './img/'.$file_name;
//
//
//        if($image->isValid()) {
//            File::move($tmp_path, $path);
//            $this->admin->insert($name, $price, $path, $description, $brand, $bracelet, $braceletColor, $category);
//            return redirect()->back()->with('message', 'Product has been added succesfully!');
//        }
//        else{
//            return redirect()->back()->with('message', 'Error!');
//        }
    }
}