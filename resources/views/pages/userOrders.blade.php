@extends('layouts.userLayout')
@section('title')
    <title>RBG | Moje narudžbine</title>
@endsection

@section('section_bottom')
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-8 col-md-offset-2" style="margin-bottom: 55px;">
            @if($orders->isEmpty())
                <h1>Trenutno nemate nijednu porudžbinu</h1><br>
                <div class="marginDiv"></div><br><br>
                <h3><a href="{{asset('/restaurants')}}">Pogledajte meni i naručite Vašu prvu dostavu</a></h3>
            @else
                <h1>Moje porudžbine</h1>  {{$orders->links()}}
            @endif
            @foreach($orders as $order)
                {{--            {{dd($order)}}--}}
                <div class="panel-login panel-default" style="border:1px solid black">
                    <div class="panel-body">
                        <ul class="list-group"  style="border:1px solid black;">

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
                                <li class="list-group-item">
                                <li class="list-group-item">
                                    Ime restorana:<strong> {{($item['item']->name)}}</strong>
                                </li>

                                <li class="list-group-item">
                                    Vreme poručivanja: <strong> {{($order->created_at)}}</strong>
                                </li><br>
                                <li class="list-group-item">
                                    Vreme dostave od naručivanja: <strong> {{($item['item']->time_delivery)}} minuta</strong>
                                </li>
                                <li class="list-group-item">
                                    Adresa za dostavu: <strong> {{($order->delivery_address)}}</strong>
                                </li><br>
                            @endforeach

                        </ul>
                    </div>
                    <div class="panel-footer">
                        <span class="badge" style="text-align:right;">Ukupna cena porudžbine: <strong style="color:white;">{{$order->cart->totalPrice}} rsd</strong></span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('sidebar_summary')
    @include('components.socialNetworks')
@endsection