@extends('layouts.userLayout')

@section('title')
    <title>RBG | Restoran</title>
@endsection

@section('section_bottom')
@if($products->isEmpty())
    <h1 class="align-center">Meni je u izradi. Hvala na strpljenju!</h1>
    <h3 class="align-center"><a href="{{'/restaurants'}}">Vratite se nazad na izbor restorana</a></h3>
    <div class="coming-soon-img" style="width: 100%;height: 396px">
        <img src="{{'/img/unnamed.jpg'}}" width="100%" height="340" alt="coming-soon"/>
    </div>
@else
    <div class="tab-content">
        {{--    Menu    --}}
        <div role="tabpanel" class="tab-pane active" id="meni">
            <div class="about-information">
                <div class="update-information">
                    <div class="container">
                        {{$products->links()}}
                        @foreach($products as $product)
                            <div class="row">
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
{{--                            @endif--}}
                        @endforeach
                        {{$products->links()}}
                    </div>
                </div>
            </div>
        </div>

        {{--   Jobs     --}}
        <div role="tabpanel" class="tab-pane" id="restaurantJobs">
            <div class="about-information">
                <div class="update-information">
                    <div class="container">
                        {{$jobs->links()}}
                        @foreach($jobs as $job)
{{--                            {{dd($userSingleJob)}}--}}
                            <div class="row">
                                <div id="products" class="row view-group">
                                    <div class="item col-xs-4 col-lg-4">
                                        <div class="thumbnailProduct card">
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
                                                @if(!session()->has('user'))
                                                    <i class="btnDisabled">
                                                        <button class="btn btn-primary btnRestaurantJobs" disabled>Konkuriši</button>
                                                        <span class="tooltip-disabledJobBtn">Morate biti ulogovani da biste konkurisali </span>
                                                    </i>
                                                @else
                                                @endif
                                            </h4>
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
            @if(session()->has('user'))
            <a class="comment-link" id="myBtn">Dodaj komentar
                <i class="fa fa-plus fa-3x"></i>
                <div id="myModal" class="modal">
                    <!-- Modal content -->

                    <div class="modal-content">
                        <form action="{{asset('/comment/add/'.$product->restaurant_id)}}" method="post">
                            {{csrf_field()}}

                            <span class="closeModal"></span>
                        Komentar:<input type="text" required name="comment" maxlength="350" class="commentInput"  placeholder="tekst komentara"><br>
                        <input type="submit" style="border: 2px solid gray;color: white;background-color: black;" class="modal-comment"  value="Objavi" >
                        </form>
                    </div>
                </div>
            </a>
            @else
                <a class="comment-link">
                    Dodaj komentar
                 <i class="btnDisabled">
                     <i class="fa fa-plus fa-2x"></i>
                     <span class="tooltip-disabledCommentBtn">Morate biti ulogovani da biste komentarisali </span>
                 </i>
             </a>
            @endif
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
    @endif
{{--</div>--}}
@endsection


@section('sidebar_section')
@if($products->isEmpty())
@else
<div class="section-block">
    <h3 class="section-title">Naš meni:</h3>
        <label class="container">
            <ul>
                @foreach($categories as $category)
                    <li>
                        <a href="{{asset('/restaurant/'.$product->restaurant_id)}}{{'/category/'.$category->category_id}}" style="text-decoration: none;">
                            <strong class="strongChbText">{{$category->category_name}}</strong><br>
                        </a>
                    </li>
                @endforeach
            </ul>
        </label>
</div>
@endif
@endsection

@section('sidebar_summary')
    @include('components.socialNetworks')
@endsection

@section('section_top')
    @if($products->isEmpty())
    @else
    <div class="section-block">
    {{-- Successfully applied to job --}}
        @if(session()->has('message'))
            <div class="alert alert-success">
                <button type="button" class="close" style="height: 20px;" data-dismiss="alert">x</button>
                {{session()->get('message')}};
            </div>
        @endif
        @if($errors->any())
            @foreach($errors->all() as $error)
            <div class="alert alert-danger">
                <button type="button" class="close" style="height: 20px;" data-dismiss="alert">x</button>
                <h4>{{$error}}</h4>
            </div>
            @endforeach
        @endif
        {{--\--}}
        <a href="{{asset('/restaurants/'.$product->restaurant_id)}}" style="text-decoration: underline darkred;">
            <h3 class="align-center singleRestaurantHeadline" style="color:darkred;">Restoran {{$product->name}}</h3>
        </a>
        <a href="{{asset('/restaurants/'.$product->restaurant_id)}}">
            <img src="{{asset($product->profile_pic)}}" class="headline-img" /><br>
        </a>
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
    </div><br>
    @endif
@endsection