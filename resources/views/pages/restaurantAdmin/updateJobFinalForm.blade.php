@extends('layouts.restaurantLayout')

@section('title')
    <title>{{session()->get('restaurant')->name}} | Promena podataka posla</title>
@endsection

@section('main')
    <form class="form-horizontal" action="{{asset('/restaurant/final-update-job/'.$updateJob->job_id)}}" method="post" enctype="multipart/form-data" style="background-color: white;">
        {{csrf_field()}}
        <fieldset>
            <!-- Form Name -->
            <legend align="center">Promena podataka posla</legend>
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
                <label class="col-md-4 control-label" for="newWage">Nova Plata</label>
                <div class="col-md-4">
                    <input id="newWage" name="newWage" type="text" class="form-control input-md" value="{{$updateJob->wage}}" required>
                </div>
            </div>
            <div class="form-group">
                {{--                {{dd($updateProduct)}}--}}
                <label class="col-md-4 control-label" for="time">Datum postavljanja oglasa</label>
                <div class="col-md-4">
                    <input id="time" name="time" disabled type="text" class="form-control input-md" value="{{$updateJob->added_at}}">
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