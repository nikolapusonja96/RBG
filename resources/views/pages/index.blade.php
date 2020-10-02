@extends('layouts.userLayout')

@section('title')
    <title>RBG | Početna</title>
@endsection

@section('section_top')
        <div class="windowSlider">
            <div class="containerHome">
                @foreach($sliderImages as $slider)
                <img class="sliderHome" src="{{asset($slider->path)}}" alt="{{$slider->alt}}">
                @endforeach
            </div>
        </div><br>
@endsection

@section('section_bottom')
    <div class="section-block">
        <div class="section-tabs">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#restorani" aria-controls="restorani" role="tab" data-toggle="tab">Restorani</a></li>
                <li role="presentation" ><a href="#poslovi" aria-controls="poslovi" role="tab" data-toggle="tab">Poslovi</a></li>
            </ul>
        </div>
    </div>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="restorani">
                <div class="update-information">
                    <h1 class="section-title" align="center"><a href="{{asset('/restaurants')}}"> Najnoviji restorani</a></h1>
                    <!--update items-->
                    <div class="container">
                        @foreach($latest_restaurants as $restaurant)
                            <div class="row">
                                <div id="products" class="row view-group">
                                    <div class="item col-xs-4 col-lg-4">
                                        <div class="thumbnail card">

                                            <div class="img-event">
                                                <img class="restaurantImg group list-group-image img-fluid" src="{{asset($restaurant->profile_pic)}}" alt="restaurant profile pic" />

                                                <h3 class="restaurantHeadline group card-title inner list-group-item-heading">
                                                    <a href="{{asset('/restaurants/'.$restaurant->id)}}">{{$restaurant->name}}</a>
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
                                                </p><br>
                                                <p class="group inner list-group-item-text"style="text-align: center"> <strong>Datum pridruživanju:</strong>
                                                    {{$restaurant->joined_at}}
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
                    @endforeach
                    </div>
                    <!--/update items-->
                </div>
            </div>
{{--     JOBS       --}}
            <div role="tabpanel" class="tab-pane" id="poslovi">
                <div class="update-information">
                    <h1 class="section-title" align="center"><a href="{{asset('/jobs')}}"> Najnoviji poslovi</a></h1>
                    <!--update items-->
                    <div class="container">
                        @foreach($latest_jobs as $job)
                            <div class="row">
                                <div id="products" class="row view-group">
                                    <div class="item col-xs-4 col-lg-4">
                                        <div class="thumbnail card">

                                            <div class="img-event">
                                                <img class="restaurantImg group list-group-image img-fluid" src="{{asset($job->profile_pic)}}" alt="restaurant profile pic" />

                                                <h3 class="restaurantHeadline group card-title inner list-group-item-heading">
                                                    <a href="{{asset('/jobs/'.$job->job_id)}}">{{$job->title}}</a>
                                                </h3>
                                            </div><br>
                                            <div class="caption card-body">
                                                <p class="group inner list-group-item-text" style="text-align: center;">
                                                    Postavio restoran: <a href="{{asset('/restaurants/'.$job->restaurant_id)}}"><b style="text-decoration: none;">{{$job->name}}</b></a>
                                                </p>
                                                <p class="group inner list-group-item-text" style="text-align: center">
                                                    Plata:<b>{{$job->wage}} RSD</b>
                                                </p><br>
                                                <p class="group inner list-group-item-text" style="text-align: center">
                                                    Postavljeno: {{$job->added_at}}
                                                </p>
                                                <div class="row">
                                                    <div class="col-xs-12 col-md-6"><br>
                                                        <a class="btn btn-success restaurantButton" href="{{asset('/jobs/'.$job->job_id)}}">Prikaži oglas</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr width="60%" style="background-color: darkgoldenrod">
                        @endforeach
                    </div>
                    <!--/update items-->
                </div>
            </div>
        </div>
@endsection

@section('sidebar_section')
<div class="section-block">
    <h1 class="section-title" style="color: #67b168 ">Najbolje ocenjeno</h1>
    @foreach($top_restaurants as $top_restaurant)

        <div class="badge badge-secondary" style="float: right;"> NOVO</div>
    <div class="reward-block popular">
        <h2 style="margin-top: -10px">
            <b style="color:deepskyblue">
                <a href="{{asset('/restaurants/'.$top_restaurant->id)}}">
                    {{$top_restaurant->name}}
                </a>
            </b>
        </h2><br>
        <h3><i>Minimum za dostavu:</i> {{$top_restaurant->min_delivery}} RSD</h3>
        <p>{{$top_restaurant->description}}</p>
        <span><i class="fa fa-users"></i>&nbsp;{{$top_restaurant->likes}} sviđanja</span>
        <a href="{{asset('/restaurants/'.$top_restaurant->id)}}" class="btn btn-reward">Poseti restoran</a>
    </div>
    @endforeach
</div>
@endsection

@section('sidebar_summary')
   @include('components.socialNetworks')
@endsection