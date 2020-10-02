@extends('layouts.userLayout')

@section('title')
    <title>RBG | Lajkovani Restorani</title>
@endsection

@section('section_bottom')
    @foreach($restaurants as $restaurant)
        <div class="row">
            <div class="item col-xs-4 col-lg-4" style="margin-bottom: 5px">
                <div class="thumbnail card">
                    <img class="likedRestaurantImg group list-group-image img-fluid" src="{{asset($restaurant->profile_pic)}}" alt="restaurant profile pic" />
                    <h3 class="restaurantHeadline group card-title inner list-group-item-heading">
                        <a href="{{asset('/restaurants/'.$restaurant->restaurant_id)}}">{{$restaurant->name}}</a>
                    </h3>
                    <b style="margin-left: 200px">Broj lajkova: {{$restaurant->likes}}</b><br><br>
                    <div class="caption card-body">
                        <div class="row">
                            <div class="col-xs-12 col-md-6"><br>
                                <a class="btn btn-success restaurantButton" href="{{asset('/restaurants/'.$restaurant->restaurant_id)}}">Prikaži meni</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr width="90%" style="background-color: darkgoldenrod">
        {{$restaurants->links()}}
    @endforeach
@endsection
@section('section_top')
    <h4 class="align-center" style="color:midnightblue">Imate {{$likedNumber}} lajkovana restorana</h4><br>
@endsection
@section('sidebar_summary')
    @include('components.socialNetworks')
@endsection