@extends('layouts.userLayout')
@section('title')
    <title>RBG | Profil korisnika</title>
@endsection

@section('sidebar_summary')
    @include('components.socialNetworks')
@endsection

@section('section_top')
    <h2 class="section-title" style="color:blue; margin-left: 250px">Podaci o korisniku</h2>
    <div class="section-block" style="background-color:#ECEBEB;height: 400px">
        <aside class="profile-card">
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="well well-sm" style="width:200%; border: none; background-color:white;">
                    <div class="row" >
                        <div class="col-sm-6 col-md-4">
                            {{--                            {{dd($user)}}--}}
                            <img src="{{asset('/img/user-profile-pic.jpg')}}" alt="user_profile_img" class="img-rounded img-responsive" /><br>
                        </div>
                        <h3>
                            {{$user->first_name}} {{$user->last_name}}
                        </h3>
                        <i class="fa fa-envelope fa-2x"></i>&nbsp;&nbsp;<b>{{$user->mail}}</b><br/>
                    </div>
                    <div class="row" >
                        <div class="col-sm-6 col-md-8">
                            <p>
                                Uloga:<i><b>&nbsp;&nbsp;{{$user->name}}</b></i><br/>
                                Adresa:&nbsp;&nbsp;<b>{{$user->address}}</b><br>
                                Broj narudžbina:&nbsp;&nbsp;<i><b>{{$ordersNumber}}</b></i><br>
                                Broj apliciranih poslova:&nbsp;&nbsp;<i><b>{{$jobNumber}}</b></i>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
    </div>
@endsection
@section('section_bottom')

@endsection