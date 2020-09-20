@extends('layouts.userLayout')


@section('title')
    <title>RBG | Restoran</title>
@endsection


@section('section_bottom')
    {{--<div class="section-block">--}}
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="meni">
            <div class="about-information">
                {{--                <h1 class="section-title">Meni</h1>--}}
                <div class="update-information">
                    <div class="container">
                        {{$products_category->links()}}
{{--                        @if($products_category == null)--}}
{{--                            <p>nema kat</p>--}}
{{--                        @endif--}}
{{--                        {{dd($products_category)}}--}}
                        @foreach($products_category as $product)
{{--                            {{dd($product)}}--}}
                            <div class="row">

{{--                                {{dd($product)}}--}}
                                <div id="products" class="row view-group">
                                    <div class="item col-xs-4 col-lg-4">
                                        <div class="thumbnailProduct card">
                                            <div class="img-event">
                                                <img class="productImg group list-group-image img-fluid" src="{{asset($product->img)}}" alt="{{$product->productDescription}}" /><br>
                                                <a href="{{asset('/add-to-cart/'.$product->product_id)}}">
                                                    <img class="img-add singleProductImg" src="{{asset('/img/add (1).png')}}" alt="plus_icon"/>
                                                </a>
                                                <h3 class="align-left group card-title inner list-group-item-heading">
                                                    <a>{{$product->productName}},<br> {{$product->grams}}g</a>
                                                </h3>
                                                <h3 class="align-center group card-title inner list-group-item-heading" style="margin-top: -45px;">
                                                    Cena: {{$product->price}} RSD
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr width="60%" style="background-color: darkgoldenrod">
                        @endforeach
                        {{$products_category->links()}}
                    </div>
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="restaurantJobs">
            <div class="about-information">
                {{--                <h1 class="section-title">Meni</h1>--}}
                <div class="update-information">
                    <div class="container">
                        {{$jobs->links()}}
                        @foreach($jobs as $job)
                            {{--                            {{dd($job)}}--}}

                            <div class="row">
                                <div id="products" class="row view-group">
                                    <div class="item col-xs-4 col-lg-4">
                                        <div class="thumbnailProduct card">
                                            {{--                                            <div class="img-event">--}}
                                            <h4 class="restaurant-jobs-txt align-left group card-title inner list-group-item-heading">
                                                <i class="job-i-txt">Pozicija:</i> &nbsp;&nbsp;&nbsp;
                                                <a href="{{asset('/jobs/'.$job->id)}}">
                                                    <i class="job-i-headline">{{$job->title}}</i>
                                                </a>
                                            </h4>
                                            <h4 class="align-left restaurant-jobs-txt group card-title inner list-group-item-heading" >
                                                <i class="job-i-txt">Plata:</i>&nbsp;&nbsp;&nbsp;
                                                <i class="job-i-text">{{$job->wage}} RSD</i>
                                            </h4>
                                            <h4 class="align-left restaurant-jobs-txt group card-title inner list-group-item-heading" >
                                                <i class="job-i-txt">Postavljeno:</i>&nbsp;&nbsp;&nbsp;
                                                <i class="job-i-text">{{$job->added_at}}</i>
                                            </h4>
                                            <h4 style="float:right" class="align-right group card-title inner list-group-item-heading" >
                                                <a href="{{asset('/application/'.$job->id)}}">
                                                    <button class="btn btn-primary btnRestaurantJobs">Konkuriši</button>
                                                </a>
                                            </h4>
                                            {{--                                            <div class="clearfix"></div>--}}
                                            <h4 style="float:right" class="group card-title inner list-group-item-heading" >
                                                <a href="{{asset('/jobs/'.$job->id)}}">
                                                    <button class="btn btn-primary btnRestaurantJobs">Poseti oglas</button>
                                                </a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr width="60%" style="background-color: darkgoldenrod">
                        @endforeach
                        {{$jobs->links()}}
                    </div>
                </div>
            </div>
        </div>

        {{--    Comments    --}}
        <div role="tabpanel" class="tab-pane" id="comments">
            <div class="update-information">
                @foreach($comments as $comment)
                    <div class="update-post" style="box-shadow: 20px 20px 50px 10px dimgray;">
                        <h4 class="update-title">{{$comment->first_name}}&nbsp;{{$comment->last_name}}</h4>
                        <span class="update-date">{{$comment->time}}</span>
                        <p>{{$comment->text}}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


    {{--</div>--}}
@endsection
{{--{{dd($products_category)}}--}}
@section('sidebar_section')
<div class="section-block">
    <h3 class="section-title">Filteri:</h3>
    <label class="container">
        <ul>
            @foreach($categories as $category)
                <li>
                    <a href="{{asset('/restaurant/'.$product->restaurant_id)}}{{'/category/'.$category->id}}" style="text-decoration: none;">
                        <strong class="strongChbText">{{$category->name}}</strong><br>
                    </a>
                </li>
            @endforeach
        </ul>
    </label>
</div>
@endsection

@section('section_top')
    <div class="section-block">
        {{-- Successfully applied to job --}}
        @if(session()->has('message'))
            <div class="alert alert-success">
                <button type="button" class="close" style="height: 20px;" data-dismiss="alert">x</button>
                {{session()->get('message')}};
            </div>
        @endif
        {{--\--}}
        <h3 class="align-center singleRestaurantHeadline" style="color:darkred;">Restoran {{$product->name}}</h3>
        <img src="{{$product->profile_pic}}" class="headline-img" /><br>
        {{--        {{dd($product)}}--}}
        <div class="section-tabs">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#meni" aria-controls="meni" role="tab" data-toggle="tab">Meni</a>
                </li>
                <li role="presentation">
                    <a href="#restaurantJobs" aria-controls="restaurantJobs" role="tab" data-toggle="tab">Poslovi<span class="qty">{{$jobs_number}}</span></a>

                </li>
                <li role="presentation" >
                    <a href="#comments" aria-controls="comments" role="tab" data-toggle="tab">Komentari<span class="qty">{{$comments_number}}</span></a>
                </li>

                @if(session()->has('user') && $like == null)
                    <a href="{{asset('/likes/'.$product->restaurant_id)}}">
                        <i class="like fa fa-thumbs-up fa-2x"><i>{{$product->likes}}</i><br>
                            <span class="tooltip-text">Sviđa mi se </span>
                        </i>
                    </a>
                @elseif(session()->has('user') && $like->user_id == session()->get('user')->UID)
                    <i class="like fa fa-thumbs-up fa-2x" style="color:darkgreen;"><i>{{$product->likes}}</i><br>
                        <span class="tooltip-text">Lajkovano </span>
                    </i>
                @else
                    <i class="like fa fa-thumbs-up fa-2x"><i>{{$product->likes}}</i><br>
                        <span class="tooltip-text">Ulogujte se da lajkujete</span>
                    </i>
                @endif
            </ul>
        </div>
    </div><br><br>
@endsection

@section('sidebar_summary')
    @include('components.socialNetworks')
@endsection

