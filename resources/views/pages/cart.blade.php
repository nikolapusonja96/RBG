@extends('layouts.userLayout')

@section('title')
    <title>RBG | Korpa</title>
@endsection

@section('section_bottom')

@if(session()->has('cart'))
<div class="row" align="center">
    <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
        <ul class="list-group">
            @foreach($products as $product)
{{--                {{dd($product)}}--}}

                <a href="{{asset('/restaurants/'.$product['item']->id)}}" style="text-decoration: none;font-weight: bold">Nazad na meni<br></a><br>

                <li class="list-group-item" style="width: 350px;box-shadow: 2px 2px 1px 4px gray inset; ">
                    <span class="badge">{{$product['qty']}}</span>

                    <img src="{{$product['item']->img}}" class="cart-img" alt="{{$product['item']->prod_description}}"/>
                    <strong>{{$product['item']->prod_name}}</strong>, {{$product['item']->grams}}g &nbsp;
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">
                            Akcija<span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{asset('/reduce/'.$product['item']->product_id)}}">Izbriši jedan proizvod</a>
                            </li>
                            <li>
                                <a href="{{asset('/removeAll/'.$product['item']->product_id)}}">Izbriši sve proizvode</a>
                            </li>
                        </ul>
                    </div>
                    <br/>
                    <span class="label label-success">Ukupna cena artikla: {{$product['price']}} RSD</span>
                </li><br>
            @endforeach
        </ul>
    </div>
</div>
<div class="row" align="center">
    <strong  style="color:black;margin-left: 61px">Ukupna cena korpe:
        <i style="color:blue;">{{$totalPrice}} RSD</i>
    </strong>
</div>
<div class="row" align="center" style="height: 340px"><br>
    <a href="{{asset('/checkout')}}">
        <button class="primary-btn cartCheckoutBtn" >Naruči <i class="fa fa-arrow-circle-right"></i></button>
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