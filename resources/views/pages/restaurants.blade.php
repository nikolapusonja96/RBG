@extends('layouts.userLayout')
@section('title')
    <title>RBG | Restorani</title>
@endsection
@section('section_top')
    <h1 align="center">Restorani</h1>
@endsection
@section('section_bottom')
    <div class="container">
        @foreach($restaurants as $restaurant)
            <div class="row">
                <div id="products" class="row view-group">
                    <div class="item col-xs-4 col-lg-4">
                        <div class="thumbnail card">
                            <div class="img-event">
                                <img class="restaurantImg group list-group-image img-fluid" src="{{asset($restaurant->profile_pic)}}" alt="restaurant profile pic" />
                                <h3 class="restaurantHeadline group card-title inner list-group-item-heading">
                                    <a href="{{asset('/restaurants/'.$restaurant->id)}}">{{$restaurant->name}}</a>
                                    <a>
                                        <i style="float:right" class="small-like fa fa-thumbs-up fa-1x">({{$restaurant->likes}})<br>
                                            <span class="tooltip-text">Posetite stranicu restorana da lajkujete </span>
                                        </i>
                                    </a>
                                </h3>
                                <p class="group inner list-group-item-text"style="text-align: center">
                                    {{$restaurant->description}}
                                </p>
                            </div><br>
                            <div class="caption card-body">
                                <p class="group inner list-group-item-text" style="text-align: center"> <strong>Minimum za besplatnu dostavu:</strong>
                                    {{$restaurant->min_delivery}} RSD
                                </p>
                                <p class="group inner list-group-item-text"style="text-align: center"> <strong>Cena dostava:</strong>
                                    {{$restaurant->delivery_cost}} RSD
                                </p>
                                <p class="group inner list-group-item-text"style="text-align: center"> <strong>Vreme za dostavu:</strong>
                                    {{$restaurant->time_delivery}}'
                                </p>
                                <br>
                                <div class="row">
                                    <div class="col-xs-12 col-md-6"><br>
                                        <a class="btn btn-success restaurantButton" href="{{asset('/restaurants/'.$restaurant->id)}}">Prikaži meni</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr width="60%" style="background-color: darkgoldenrod">
            {{$restaurants->links()}}
        @endforeach
    </div>
@endsection

@section('sidebar_section')
<div class="section-block fixed">
    <h3 class="section-title">Kuhinja:</h3>
    @foreach($kitchens as $kitchen)
    <label class="container">
        <a style="text-decoration: none" href="{{asset('/restaurants/kitchen/'.$kitchen->id)}}">
            <li>
                <strong class="strongChbText">{{$kitchen->name}}</strong>
            </li>
        </a>
    </label>
    @endforeach
</div>
@endsection

@section('sidebar_summary')
    @include('components.socialNetworks')
@endsection