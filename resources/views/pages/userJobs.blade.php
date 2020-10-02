@extends('layouts.userLayout')

@section('title')
    <title>RBG | Aplicirani poslovi</title>
@endsection

@section('section_bottom')
    {{$jobs->links()}}

    <div class="section-block" style="margin-bottom: 200px;">
    @foreach($jobs as $job)
{{--        {{dd($job)}}--}}
<div class="row">
            <div id="products" style="margin-bottom: 20px" class="row view-group">
                <div class="item col-xs-4 col-lg-4">
                    <div class="thumbnailProduct card">
                        <h4 class="restaurant-jobs-txt align-left group card-title inner list-group-item-heading">
                            <i class="job-i-txt">Pozicija:</i> &nbsp;&nbsp;&nbsp;
                            <a href="{{asset('/jobs/'.$job->job_id)}}">
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
                        <h4 style="float:right" class="group card-title inner list-group-item-heading" >
                            <a href="{{asset('/jobs/'.$job->job_id)}}">
                                <button class="btn btn-primary btnRestaurantJobs">Poseti oglas</button>
                            </a>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection

@section('section_top')
    <h4 class="align-center" style="color:midnightblue">Imate {{$jobNumber}} aplikacija/u/e za posao</h4><br>
@endsection
@section('sidebar_summary')
    @include('components.socialNetworks')
@endsection