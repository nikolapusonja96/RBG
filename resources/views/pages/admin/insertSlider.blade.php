@extends('layouts.restaurantLayout')

@section('title')
    <title>RBG | AdminPanel</title>
@endsection

@section('main')
    <form class="form-horizontal" action="{{asset('/admin/insert-slider')}}" method="post" enctype="multipart/form-data" style="background-color: white;">
        {{csrf_field()}}
        <fieldset>
            <!-- Form Name -->
            <legend align="center">Dodavanje slike u slajder</legend>
            @if(count($errors)>0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </div>
        @endif
        <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="description">Kratki opis slike</label>
                <div class="col-md-4">
                    <input id="description" name="description" type="text" class="form-control input-md" required>
                </div>
            </div>
            <!-- File input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="sliderImg">Slika</label>
                <div class="col-md-4">
                    <input type="file"  id="sliderImg" name="sliderImg" class="form-control-file" required>
                </div>
            </div>
            <!--DropDown List-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="slider">Tip slidera</label>
                <div class="col-md-4">
                    <select class="form-control" name="slider" id="slider" required>
                        <option value="1">Veliki</option>
                        <option value="2">Mali</option>
                    </select>
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

