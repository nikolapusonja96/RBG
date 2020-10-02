@extends('layouts.restaurantLayout')

@section('title')
    <title> {{$infos->name}} | Restoran panel</title>
@endsection

@section('main')
    <div class="row">
        <div class="col-md-6"  align="center" style="margin-left: 100px">
            <div class="panel panel-primary" style="width: 900px;">
                <div class="panel-heading">
                    <h3 class="panel-title"> Podaci restorana</h3>
                </div>
                <div class="panel-body" style="padding: 2px;">
                    <div class="row">
                        <div class="col-xs-6 col-md-6 col-lg-12">
                            <table class="table text-center table-bordered">
                                <thead>
                                <tr>
                                    <th style="padding-bottom:30px;" class="text-center">Slika</th>
                                    <th style="padding-bottom: 20px;">Ime restorana</th>
                                    <th style="padding-bottom: 30px;" class="text-center">Opis</th>
                                    <th style="padding-bottom: 30px;" class="text-center">Lokacija</th>
                                    <th>Minimum cena za dostavu</th>
                                    <th style="padding-bottom: 20px;" class="text-center">Cena dostave</th>
                                    <th class="text-center">Max. vreme dostave od naručivanje</th>
                                    <th style="padding-bottom: 30px;" class="text-center">Email</th>
                                    <th class="text-center">Vreme pridruživanja sajtu</th>
                                    <th style="padding-bottom: 20px;" class="text-center">Broj lajkova</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <img src="{{asset($infos->profile_pic)}}" alt="restaurant profile pic" width="90" height="60"/>
{{--                                            <img src="{{asset(session()->get('restaurant')->profile_pic)}}"  alt="{{session()->get('restaurant')->name}}" width="90" height="60"/>--}}
                                        </td>
                                        <td style="padding-top: 30px;">
                                            {{$infos->name}}
                                        </td>
                                        <td style="padding-top: 25px;">
                                            {{$infos->description}}
                                        </td>
                                        <td style="padding-top: 25px;">
                                            {{$infos->location}}
                                        </td>
                                        <td style="padding-top: 30px;">
                                            {{$infos->min_delivery}} rsd
                                        </td>
                                        <td style="padding-top: 30px;">
                                            {{$infos->delivery_cost}} rsd
                                        </td>
                                        <td style="padding-top: 30px;">
                                            {{$infos->time_delivery}}'
                                        </td>
                                        <td style="padding-top: 30px;">
                                            {{$infos->email}}
                                        </td>
                                        <td style="padding-top: 30px;">
                                            {{$infos->joined_at}}
                                        </td>
                                        <td style="padding-top: 30px;">
                                            {{$infos->likes}}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-primary" style="margin-left: 230px;width: 480px;">
                <div class="panel-heading">
                    <h3 class="panel-title"> Prečice</h3>
                </div>
                <div class="panel-body" style="padding: 20px;">
                    <div class="row">
                        <div class="col-xs-6 col-md-6">
                            <a href="{{asset('/restaurant/orders')}}" class="btn btn-warning btn-lg" style="margin-bottom: 20px" role="button">Narudžbine</a>
                            <a href="{{asset('/restaurant/comments')}}" class="btn btn-success btn-lg" role="button">Komentari</a>
                        </div>
                        <div class="col-xs-6 col-md-6">
                            <a href="{{asset('/restaurant/jobs')}}" class="btn btn-success btn-lg" role="button" style="margin-bottom: 20px">Poslovi</a>
                            <a href="{{asset('/restaurant/applicants')}}" class="btn btn-warning btn-lg" role="button">prijavljeni kandidati</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
