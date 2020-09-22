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

        $idR = $product->restaurant_id; //currently added restaurant_id
        //
        $oldCart = session()->has('cart') ? session()->get('cart') : null;
//        dd($oldCart);

        $cart = new CartModel($oldCart);
//        dd($cart, $idR, $oldCart->idR);

        if ($oldCart)
        {

            $cart->idR = $idR;
//            dd($oldCart->idR, $idR, $cart->idR);
            if ($oldCart->idR != $idR)
            {
                return redirect()->back()->withErrors([
                    'Trenutno u korpi imate porizvode iz drugog restorana',
                    'Nije moguće istovremeno dodati proizvode iz različitih restorana '
                ]);
            }
            else{
//                dd($cart, $oldCart);
                $cart->add($product, $product->PID); //,PID = proizvod ID
//                dd($cart);
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
//        dd(session()->get('cart'));


        $oldCart = session()->get('cart');
//          dd($oldCart);
        $cart = new CartModel($oldCart, $oldCart->idR); //sta je 1
//          dd($cart->idR);

        //dodato je id restorano u isti rang kao items
        return view('pages.cart', $this->data, [
            'products' => $cart->items,
            'totalPrice' => $cart->totalPrice
        ]);
    }

    public function reduceByOne(Request $request, $id)
    {
        $oldCart = session()->has('cart') ? session()->get('cart') : null;
        $cart = new CartModel($oldCart);
        $cart->reduceByOne($id);

        if(count($cart->items) > 0)
        {
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

        if(count($cart->items) > 0)
        {
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
//          dd(session()->get('cart')); //ovde treba da se stavi id i da se prosledi na checkout

        $idR = session()->get('cart')->idR;
        $oldCart = session()->get('cart');
        $cart = new CartModel($oldCart, $idR);
        $total = $cart->totalPrice;

        return view('pages.checkout', $this->data, [
            'total' => $total,
            'idRestaurant' => $idR
        ]);
    }

    public function placeOrder(Request $request)
    {
        if(!session()->has('cart'))
        {
            return view('pages.cart', $this->data);
        }

        $idRestaurant = session()->get('cart')->idR;
        $oldCart = session()->get('cart');
        $cart = new CartModel($oldCart, $idRestaurant);

//          dd($oldCart);
        if ($oldCart->items[$idRestaurant]['item']->delivery_cost > 0)
        {
            $oldCart->totalPrice += $oldCart->items[$idRestaurant]['item']->delivery_cost;
        }
//          dd($oldCart);
//          dd($cart);
        $order = new OrdersModel();

//  {{session()->get('cart')->items[$idRestaurant]['item']->delivery_cost}}

        $order->cart = serialize($cart);
        $order->firstName = session()->get('user')->first_name;
        $order->lastName = session()->get('user')->last_name;
        $order->idRestaurant = $idRestaurant;

        $order->deliveryAddress = $request->input('address');
        $order->phone = $request->input('phone');

        $order->addOrder();
        session()->forget('cart');

        return redirect('/');
//          return redirect('/user-orders/'.session()->get('user')->UID)->with('message', 'Vaša porudžbina je uspešno prosleđena restoranu');
    }

}