@extends('layouts.restaurantLayout')

@section('title')
    <title>RBG | AdminPanel</title>
@endsection

@section('main')
    <form class="form-horizontal" action="{{asset('/admin/insert-category')}}" method="post" style="background-color: white;">
        {{csrf_field()}}
        <fieldset>
            <!-- Form Name -->
            <legend align="center">Dodavanje kategorije</legend>
            @if(count($errors)>0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </div>
        @endif
        <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="categoryName">Naziv kategorije</label>
                <div class="col-md-4">
                    <input id="categoryName" name="categoryName" type="text" class="form-control input-md" required>
                </div>
            </div>
            <!-- \Text input-->

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