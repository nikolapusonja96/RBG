@extends('layouts.restaurantLayout')

@section('title')
    <title>{{session()->get('restaurant')->name}} | Komentari</title>
@endsection

@section('main')
<div class="row">
    <div class="col-md-6"  align="center" style="margin-left: 250px">
        <div class="panel panel-primary" style="border:none;">
            <div class="panel-heading">
                <h3 class="panel-title"> Komentari ({{$commentsNumber}})</h3>
            </div>
            <div class="update-information">
            @foreach($comments as $comment)
            <div style="box-shadow: 5px 20px 30px dimgray;">
                <h4 style="color:dodgerblue">{{$comment->first_name}}&nbsp;{{$comment->last_name}}</h4>
                <span class="pull-right" style="margin-top: -35px;margin-right: 3px;">{{$comment->time}}</span>
                <h3 style="padding-bottom: 5px;">{{$comment->text}}</h3>
            </div>
            @endforeach
            </div>
        </div>
    </div>
</div>
@endsection