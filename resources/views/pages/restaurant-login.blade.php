@extends('layouts.userLayout')

@section('title')
    <title>RBG | Restoran Logovanje</title>
@endsection

@section('section_top')
    @if(session()->has('success'))
        <div class="alert alert-success">
            <button type="button" class="close" style="height: 20px;" data-dismiss="alert">x</button>
            {{ session()->get('success') }}
        </div>
    @endif
    <div class="loginBg section-block">
        <div class="panel-login panel-default loginForm">
            <div class="panel-heading">
                <h3 class="panel-title align-center">Unesite podatke restorana</h3>
            </div>
            <div class="panel-body">
                <form action="{{asset('/login-restaurant')}}" method="post" id="loginForm" accept-charset="UTF-8" role="form">
                    {{csrf_field()}}
                    <fieldset>
                        <div class="form-group">
                            Email: <input class="form-control" placeholder="E-mail" name="emailRestaurant" type="text" required>
                        </div>
                        <div class="form-group">
                            Lozinka:
                            <input class="form-control" placeholder="Lozinka" name="passwordRestaurant" type="password" required>
                        </div><br><br>
                        <input class="btn btn-primary btn-success btn-block" type="submit" value="Uloguj se" style="background-color: steelblue">
                    </fieldset>
                </form>
            </div>
        </div>
        @if(session()->has('message'))
            <div class="alert alert-danger">
                <button type="button" class="close" style="height: 20px;" data-dismiss="alert">x</button>
                {{ session()->get('message') }}
            </div>
        @endif
    </div>
@endsection

@section('sidebar_summary')
    @include('components.socialNetworks')
@endsection