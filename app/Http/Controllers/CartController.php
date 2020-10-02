<?php


namespace App\Http\Controllers;
use App\Http\Models\CartModel;
use App\Http\Models\OrdersModel;
use Illuminate\Http\Request;

class CartController extends FrontendController
{
    public function addToCart(Request $request, $id)
    {
        $product = $this->product->getCartSingleProduct($id);
//        dd($product);
        $idR = $product->restaurant_id; //currently added restaurant_id

        $oldCart = session()->has('cart') ? session()->get('cart') : null;
//        dd($oldCart);

        $cart = new CartModel($oldCart);

        if ($oldCart)
        {
            $cart->idR = $idR;
            if ($oldCart->idR != $idR)
            {
                return redirect()->back()->withErrors([
                    'Trenutno u korpi imate porizvode iz drugog restorana',
                    'Nije moguće istovremeno dodati proizvode iz različitih restorana '
                ]);
            }
            else{
                $cart->add($product, $product->PID); //PID = product id
                $request->session()->put('cart', $cart);

                return redirect()->back()->with('message', 'Uspešno ste dodali proizvod u korpu!');
            }
        }
        else
        {
            $cart->add($product, $product->PID); //PID = product_id
            $cart->idR = $idR;
            $request->session()->put('cart', $cart);

            return redirect()->back()->with('message', 'Uspešno ste dodali proizvod u korpu!');
        }
    }

    public function getCart()
    {
        if (!session()->has('cart'))
        {
            return view('pages.cart', $this->data);
        }

        $oldCart = session()->get('cart');
        $cart = new CartModel($oldCart, $oldCart->idR);
//        dd($cart);

        return view('pages.cart', $this->data, [
            'products' => $cart->items,
            'totalPrice' => $cart->totalPrice
        ]);
    }

    public function reduceByOne(Request $request, $id)
    {
        $oldCart = session()->has('cart') ? session()->get('cart') : null;
        $cart = new CartModel($oldCart);
//        dd($cart);
        $cart->reduceByOne($id);
        $idR = $this->product->getCartSingleProduct($id);

        if(count($cart->items) > 0)
        {
            $cart->idR = $idR->restaurant_id;
            $request->session()->put('cart', $cart);
        }
        else
        {
            session()->forget('cart');
        }

        return redirect()->back()->with('message', 'Uspešno ste obrisali jedan proizvod!');
    }

    public function removeAll(Request $request, $id)
    {
        $oldCart = session()->has('cart') ? session()->get('cart') : null;
        $cart = new CartModel($oldCart);
        $cart->removeAll($id);
        $idR = $this->product->getCartSingleProduct($id);

        if(count($cart->items) > 0)
        {
            $cart->idR = $idR->restaurant_id;
            $request->session()->put('cart', $cart);
        }
        else
        {
            session()->forget('cart');
        }

        return redirect()->back()->with('message', 'Uspešno ste obrisali sve proizvode!');
    }

    public function getCheckout()
    {
        if (!session()->has('cart'))
        {
            return view('pages.index', $this->data);
        }
        $restaurantInfo = $this->restaurant->getCheckoutRestaurantInfo();
//        dd($restaurantInfo);
        $oldCart = session()->get('cart');
        $cart = new CartModel($oldCart);
        $total = $cart->totalPrice;

        return view('pages.checkout', $this->data, [
            'total' => $total,
            'restaurant' => $restaurantInfo
        ]);
    }

    public function placeOrder(\App\Http\Requests\Checkout $request)
    {
        if(!session()->has('cart'))
        {
            return view('pages.cart', $this->data);
        }

        $idRestaurant = session()->get('cart')->idR;
        $oldCart = session()->get('cart');
        $cart = new CartModel($oldCart, $idRestaurant);

        $restaurant = $this->restaurant->getCheckoutRestaurantInfo();

        if ($restaurant->delivery_cost > 0)
        {
            $oldCart->totalPrice += $restaurant->delivery_cost;
            $cart->totalPrice += $restaurant->delivery_cost;
        }

        $order = new OrdersModel();

        $order->cart = serialize($cart);
        $order->firstName = session()->get('user')->first_name;
        $order->lastName = session()->get('user')->last_name;
        $order->idRestaurant = $idRestaurant;
        $order->deliveryAddress = $request->input('address');
        $order->phone = $request->input('phone');

//        dd($order, session()->get('user')->UID);
        $order->addOrder();
        session()->forget('cart');

        return redirect(asset('/user-orders'))->with('message', 'Vaša porudžbina je uspešno prosleđena restoranu');
    }
}