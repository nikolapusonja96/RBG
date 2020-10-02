@extends('layouts.restaurantLayout')

@section('title')
    <title>{{session()->get('restaurant')->name}} | Poslovi</title>
@endsection
@section('main')
<div class="row">
    <div class="col-md-6"  align="center" style="margin-left: 250px">
        <div class="panel panel-primary" style="border:none;">
            <div class="panel-heading">
                <h3 class="panel-title"> Poslovi ({{$jobsNumber}})</h3>
            </div>
            <div class="update-information">
                @foreach($jobs as $job)
                    <div style="box-shadow: 10px 0px 40px 0px dimgray;">
                        <h4 style="color:dodgerblue">{{$job->title}}</h4>
                        <h6>Plata: {{$job->wage}}</h6>
                        <span class="pull-right" style="margin-top: -60px;margin-right: 3px;">{{$job->added_at}}</span>
                        <a href="{{asset('/restaurant/job/applicants/'.$job->id)}}">
                            <button type="button" style="margin-bottom: 2px" class="btn btn-success btn-xs">
                                <i>lista prijavljenih</i>
                            </button>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection