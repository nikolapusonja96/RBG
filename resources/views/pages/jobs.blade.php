@extends('layouts.userLayout')
@section('title')
    <title>RBG | Poslovi</title>
@endsection

@section('sidebar_summary')
    @include('components.socialNetworks')
@endsection

@section('section_top')
    <h1 align="center">Oglasi za posao</h1>
@endsection

@section('sidebar_section')
<div class="section-block">
    <h1 class="section-title" style="color:darkgreen">Najnoviji oglas</h1>

    <div class="reward-block">
    <div class="badge badge-secondary" style="float: right;"> NOVO</div>
    <h2 style="color:forestgreen;"><a href="{{asset('/jobs/'.$job->job_id)}}">{{$job->title}}</a></h2>
    Oglas postavljen: <p>{{$job->added_at}}</p>
    <a href="{{asset('/jobs/'.$job->job_id)}}" class="btn btn-reward">Vidi oglas</a>
</div>
</div>
@endsection

@section('section_bottom')
    <div class="update-information">
        <!--update items-->
        <div class="container">
            {{$jobs->links()}}
            @foreach($jobs as $job)
                <div class="row">
                    <div id="products" class="row view-group">
                        <div class="item col-xs-4 col-lg-4">
                            <div class="thumbnail card">
                                <div class="img-event">
                                    <img class="jobImg group list-group-image img-fluid" src="{{asset($job->profile_pic)}}" alt="restaurant profile pic" /><br>
                                    <h3 class="restaurantHeadline group card-title inner list-group-item-heading">
                                        <a href="{{asset('/jobs/'.$job->job_id)}}">{{$job->title}}</a>
                                    </h3><br><br>
                                </div>
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
            {{$jobs->links()}}
        </div>
        <!--/update items-->
    </div>
@endsection
