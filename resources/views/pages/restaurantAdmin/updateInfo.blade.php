@extends('layouts.restaurantLayout')

@section('title')
    <title>{{session()->get('restaurant')->name}} | Promena podataka restorana</title>
@endsection
{{--{{dd(session()->get('restaurant'))}}--}}
@section('main')
    <form class="form-horizontal" action="{{asset('/restaurant/update')}}" method="post" enctype="multipart/form-data" style="background-color: white;">
        {{csrf_field()}}
        <fieldset>
            <!-- Form Name -->
            <legend align="center">Promena podataka restorana</legend>
            @if(count($errors)>0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </div>
            @endif
        <!-- Text input-->
            <div class="form-group">
                {{--                {{dd($updateProduct)}}--}}
                <label class="col-md-4 control-label" for="newRestaurantName">Novo ime restorana</label>
                <div class="col-md-4">
                    <input id="newRestaurantName" name="newRestaurantName" type="text" class="form-control input-md" value="{{session()->get('restaurant')->name}}" required>
                </div>
            </div>
            <div class="form-group">
                {{--                {{dd($updateProduct)}}--}}
                <label class="col-md-4 control-label" for="newRestaurantDescription">Novi opis restorana</label>
                <div class="col-md-4">
                    <input id="newRestaurantDescription" name="newRestaurantDescription" type="text" class="form-control input-md" value="{{session()->get('restaurant')->description}}" required>
                </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="newDeliveryPrice">Nova cena dostave</label>
                <div class="col-md-4">
                    <input id="newDeliveryPrice" name="newDeliveryPrice" type="text" class="form-control input-md" value="{{session()->get('restaurant')->delivery_cost}}" required>
                </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="newMin">Novi minimum za kućnu dostavu</label>
                <div class="col-md-4">
                    <input id="newMin" name="newMin" type="text" class="form-control input-md" value="{{session()->get('restaurant')->min_delivery}}" required>
                </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="newTime">Novo minimalno vreme dostave </label>
                <div class="col-md-4">
                    <input id="newTime" name="newTime" type="text" class="form-control input-md" value="{{session()->get('restaurant')->time_delivery}}" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="newLocation">Nova lokacija</label>
                <div class="col-md-4">
                    <input id="newLocation" name="newLocation" type="text" class="form-control input-md" value="{{session()->get('restaurant')->location}}" required>
                </div>
            </div>
            <!-- File input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="newRestaurantProfilePic">Nova slika profila</label>
                <div class="col-md-4">
                    <input type="file"  id="newRestaurantProfilePic" name="newRestaurantProfilePic" class="form-control-file">
                </div>
            </div>
            <!-- Submit -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="submit"></label>
                <div class="col-md-4">
                    <input type="submit" id="submit" name="submit" value="Promeni" class="btn btn-primary btn-lg" style="width:100%">
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