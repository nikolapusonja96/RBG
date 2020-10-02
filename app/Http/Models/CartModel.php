<?php


namespace App\Http\Models;

class CartModel
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;
    public $idR;

    public function  __construct($oldCart)
    {
        if($oldCart){
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($item, $id)
    {
        $storedItem = [
            'qty' => 0,
            'price' => $item->price,
            'item' => $item,
//            'idR' => $item->restaurant_id
        ];

        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
            }
        }

        $storedItem['qty']++;
        $storedItem['price'] = $item->price * $storedItem['qty'];
        $this->items[$id] = $storedItem;
        $this->totalQty++;
        $this->totalPrice += $item->price;
    }

    public function reduceByOne($id)
    {
//        dd($id);
        $this->items[$id]['qty']--;
        $this->items[$id]['price'] -= $this->items[$id]['item']->price;
        $this->totalQty--;
        $this->totalPrice -= $this->items[$id]['item']->price;

        if ($this->items[$id]['qty'] <= 0)
        {
            unset($this->items[$id]);
        }
    }

    public function removeAll($id)
    {
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['item']->price * $this->items[$id]['qty'];

        unset($this->items[$id]);
    }
}