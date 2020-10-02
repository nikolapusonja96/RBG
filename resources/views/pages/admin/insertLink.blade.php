@extends('layouts.restaurantLayout')

@section('title')
    <title>RBG | AdminPanel</title>
@endsection

@section('main')
    <form class="form-horizontal" action="{{asset('/admin/insert-link')}}" method="post" style="background-color: white;">
        {{csrf_field()}}
        <fieldset>
            <!-- Form Name -->
            <legend align="center">Dodavanje linka</legend>
            @if(count($errors)>0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </div>
        @endif
        <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="linkName">Naziv linka</label>
                <div class="col-md-4">
                    <input id="linkName" name="linkName" type="text" class="form-control input-md" required>
                </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="path">Putanja linka</label>
                <div class="col-md-4">
                    <input id="path" name="path" type="text" class="form-control input-md" required>
                </div>
            </div>
            <!-- Submit -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="submit"></label>
                <div class="col-md-4">
                    <input type="submit" id="submit" name="submit" value="Dodaj" class="btn btn-primary btn-lg" style="width:100%">
                </div>
            </div>
        </fieldset>
    </form>
    @if(session()->has('message'))
        <div class="alert alert-warning">
            <button type="button" class="close" data-dismiss="alert">x</button>
            {{ session()->get('message') }}
        </div>
    @endif
@endsection
