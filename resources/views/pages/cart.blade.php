@extends('layouts.userLayout')

@section('title')
    <title>RBG | Korpa</title>
@endsection

@section('section_bottom')

@if(session()->has('cart'))
{{--@section('section_top')--}}
{{--    <h3 class="section-title">Vasa korpa</h3>--}}
{{--@endsection--}}
<div class="row" align="center">
    <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
        <ul class="list-group">
{{--            {{dd(session()->get('cart'))}}--}}
            @foreach($products as $product)
                <a href="{{asset('/restaurants/'.$product['item']->id)}}" style="text-decoration: none;font-weight: bold">Nazad na meni<br></a><br>
                <li class="list-group-item" style="width: 350px;box-shadow: 5px 5px 1px 4px yellow ; ">
                    <span class="badge">{{$product['qty']}}</span>

                    <img src="{{$product['item']->img}}" class="cart-img" alt="{{$product['item']->description}}"/>
                    <strong>{{$product['item']->name}}</strong>&nbsp;&nbsp;
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">
                            Akcija<span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{asset('/reduce/'.$product['item']->id)}}">Izbriši jedan proizvod</a>
                            </li>
                            <li>
                                <a href="{{asset('/removeAll/'.$product['item']->id)}}">Izbriši sve proizvode</a>
                            </li>
                        </ul>
                    </div>
                    <br/>
                    <span class="label label-success">Ukupna cena: {{$product['price']}} RSD</span>
                </li><br>
            @endforeach
        </ul>
    </div>
</div>
<div class="row" align="center">
    <strong  style="color:black;">Ukupna cena porudžbine: <i style="color:blue;">{{$totalPrice}} RSD</i></strong>
</div>
<div class="row" align="center" style="height: 340px"><br>
    <a href="{{asset('/checkout')}}">
        <button class="primary-btn" style="margin-left: 150px; margin-top: -10px;width: 23%">Naruči <i class="fa fa-arrow-circle-right"></i></button>
    </a>
</div>

@else
@section('section_top')
    <h2 class="section-title" style="color:midnightblue;margin-left: 250px;">Vaša korpa je prazna</h2>
@endsection

<div class="row" align="center">
    <img src="{{asset('img/empty-cart.png')}}" alt="emptyCart" width="370" height="430"/>
</div>
@endif

@if(session()->has('message'))
    <div class="alert alert-danger">
        {{session()->get('message')}}
        <a href="{{asset('/login')}}"></a>
    </div>
@endif

@endsection

@section('sidebar_summary')
    @include('components.socialNetworks')
@endsection