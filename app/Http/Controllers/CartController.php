<?php


namespace App\Http\Controllers;
use App\Http\Models\CartModel;
use Illuminate\Http\Request;

class CartController extends FrontendController
{
      public function addToCart(Request $request, $id)
      {
          $product = $this->product->getCartSingleProduct($id);

//          dd($product);
//          $idR = $product->restaurant_id; //id restorana
//          dd($idR);

          $oldCart = session()->has('cart') ? session()->get('cart') : null;

          //null treba da stoji
//          if ($oldCart == null){
//
//              $cart = new CartModel($oldCart, $idR);
//              $cart->add($product, $product->id,$idR);
//              dd($cart);
//          }

//          dd($oldCart);
          $cart = new CartModel($oldCart); //, $idR

          $cart->add($product, $product->id); //,$idR
//                dd($cart);


          $request->session()->put('cart', $cart);
//                dd($cart);

          return redirect()->back()->with('message', 'Uspešno ste dodali proizvod u korpu!');

////          if ($oldCart->idR != $idR)
////          {
////              return redirect('/');
////          }
////            else {
//                $cart->add($product, $product->id,$idR);
////                dd($cart);
//
//
//                $request->session()->put('cart', $cart);
////                dd($cart);
//
//                return redirect()->back()->with('message', 'Uspešno ste dodali proizvod u korpu!');
////            }
      }

      public function getCart()
      {
          if (!session()->has('cart'))
          {
              return view('pages.cart', $this->data);
          }

          $oldCart = session()->get('cart');
          $cart = new CartModel($oldCart, 1);

          return view('pages.cart', $this->data, [
             'products' => $cart->items,
             'totalPrice' => $cart->totalPrice
          ]);
      }

      public function reduceByOne(Request $request, $id)
      {
          $oldCart = session()->has('cart') ? session()->get('cart') : null;
          $cart = new CartModel($oldCart, 1);
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
          $cart = new CartModel($oldCart,1);
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
}