@extends('layouts.restaurantLayout')

@section('title')
    <title>{{session()->get('restaurant')->name}} | Dodavanje oglasa za posao</title>
@endsection

@section('main')

    <form class="form-horizontal" action="{{asset('/restaurant/insert-job')}}" method="post" enctype="multipart/form-data" style="background-color: white;">
        {{csrf_field()}}
        <fieldset>
            <!-- Form Name -->
            <legend align="center">Dodavanje oglasa za posao</legend>
            @if(count($errors)>0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </div>
        @endif
        <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="jobName">Pozicija</label>
                <div class="col-md-4">
                    <input id="jobName" name="jobName" type="text" class="form-control input-md" required>
                </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="wage">Plata</label>
                <div class="col-md-4">
                    <input id="wage" name="wage" type="number" class="form-control input-md" required>
                </div>
            </div>

            <!-- Textarea-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="description">Opis posla<br><small style="color:red;">max.1000 karaktera</small></label>
                <div class="col-md-4">
                    <textarea name="description" maxlength="1000"></textarea>
                </div>
            </div>
            <!-- Textarea-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="requirements">Uslovi prijave<br><small style="color:red;">max.1000 karaktera</small></label>
                <div class="col-md-4">
                    <textarea name="requirements" maxlength="1000"></textarea>
                </div>
            </div>
            <!-- Textarea-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="offer">Naša ponuda<br><small style="color:red;">max.1000 karaktera</small></label>
                <div class="col-md-4">
                    <textarea name="offer" maxlength="1000"></textarea>
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