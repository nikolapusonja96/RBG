@extends('layouts.userLayout')

@section('title')
    <title>RBG | Logovanje</title>
@endsection

@section('section_top')
    @if(session()->has('success'))
        <div class="alert alert-success">
            <button type="button" class="close" style="height: 20px;" data-dismiss="alert">x</button>
            {{ session()->get('success') }}
        </div>
    @endif
    <div class="loginBg section-block">
{{--        <div class="row">--}}
{{--            <div class="col-md-4 col-md-offset-4" style="border:2px solid green;">--}}
                <div class="panel panel-default loginForm">
                    <div class="panel-heading">
                        <h3 class="panel-title align-center">Unesite podatke</h3>
                    </div>
                    <div class="panel-body">
                        <form action="{{asset('/login')}}" method="post" id="loginForm" accept-charset="UTF-8" role="form">
                            {{csrf_field()}}
                            <fieldset>
                                <div class="form-group">
                                    Email: <input class="form-control" placeholder="E-mail" name="email" type="text" required>
                                </div>
                                <div class="form-group">
                                    Lozinka:
                                    <input class="form-control" placeholder="Lozinka" name="password" type="password" required>
                                </div><br><br>
{{--                                <a>--}}
                                    <input class="btn btn-lg btn-success btn-block" type="submit" value="Uloguj se" style="background-color: steelblue">
{{--                                </a>--}}
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
{{--            </div>--}}
{{--        </div>--}}
    </div>
@endsection

@section('sidebar_summary')
    @include('components.socialNetworks')
@endsection