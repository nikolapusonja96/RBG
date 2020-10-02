@extends('layouts.restaurantLayout')

@section('title')
    <title>{{session()->get('restaurant')->name}} | Porudžbine</title>
@endsection

@section('refresh')
    <meta http-equiv="refresh" content="120">
@endsection

@section('main')
    <div class="row">
        <div class="col-md-8 col-md-offset-2" style="margin-bottom: 15px;">
            <b class="align-center">Stranica se sama osvežava na 2 minuta</b>
            @foreach($orders as $order)
                {{--                        {{dd($order)}}--}}
                <div class="panel panel-default">
                    <div class="panel-body">
                        <ul class="list-group">
                            {{$orders->links()}}
                            {{--                            {{dd($item)}}--}}
                            <li class="list-group-item">
                                Ime korisnika:<strong> {{($order->firstName)}} {{$order->lastName}}</strong>
                            </li>
                            <li class="list-group-item">
                                Kontakt telefon:<strong> {{($order->phone)}}</strong>
                            </li>
                            @foreach($order->cart->items as $item)
                                <li class="list-group-item">
                                    Naziv proizvoda:<strong> {{($item['item']->prod_name)}}</strong>
                                    <span class="badge" style="float:right;">
                                     {{($item['qty'])}} komada
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    Cena 1 komada: <strong> {{($item['item']->price)}} rsd</strong>
                                </li>
                            @endforeach
                            <li class="list-group-item">
                                Vreme poručivanja: <strong> {{($order->created_at)}}</strong>
                            </li>
                            <li class="list-group-item">
                                Vreme dostave od naručivanja: <strong> {{($item['item']->time_delivery)}} minuta</strong>
                            </li>
                            <li class="list-group-item">
                                Adresa za dostavu: <strong> {{($order->delivery_address)}}</strong>
                            </li><br>

                        </ul>
                    </div>
                    <div class="panel-footer">
                        <span class="badge" style="margin-left: 228px;">Ukupna cena porudžbine: <strong style="color:white;">{{$order->cart->totalPrice}} rsd</strong></span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection