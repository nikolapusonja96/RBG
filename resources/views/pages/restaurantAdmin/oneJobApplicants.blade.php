@extends('layouts.restaurantLayout')

@section('title')
    <title>{{session()->get('restaurant')->name}} | Kandidati</title>
@endsection

@section('main')
    <div class="row">
        <div class="col-md-6"  align="center" style="margin-left: 250px">
            <div class="panel panel-primary" style="border:none;">
                {{$applicants->links()}}
                <div class="panel-heading">
                    @if($position == null)
                        <h3 class="panel-title"> Trenutno nemate prijavljenih kandidata za ovu poziciju</h3>
                    @else
                    <h3 class="panel-title"> Pozicija: <i style="color:black"> {{$position->title}}</i><br><br>Kandidati ({{$applicantsNumber}})</h3>
                    @endif
                </div>
                <div class="update-information">
                    @foreach($applicants as $applicant)
                        <div style="box-shadow: 5px 0px 40px 0px dimgray inset;padding-bottom: 2px;border-radius: 30%;">
                            <h4 style="color:black">Kandidat: <i style="color:mediumblue">{{$applicant->first_name}} {{$applicant->last_name}}</i></h4>
                            <h4 style="color:darkslategray">E-mail: <i style="color:mediumblue">{{$applicant->mail}}</i></h4>
                            <h4 style="color:darkslategray">Oglas postavljen: {{$applicant->added_at}}</h4>
                            <h4 style="color:black">Datum prijave: {{$applicant->applied_at}}</h4>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection