@extends('layouts.restaurantLayout')

@section('title')
    <title>{{session()->get('restaurant')->name}} | Dodavanje proizvoda</title>
@endsection

@section('main')
    <form class="form-horizontal" action="{{asset('/restaurant/insert-product')}}" method="post" enctype="multipart/form-data" style="background-color: white;">
        {{csrf_field()}}
        <fieldset>
            <!-- Form Name -->
            <legend align="center">Dodavanje proizvoda</legend>
            @if(count($errors)>0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </div>
            @endif
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="productName">Ime proizvoda</label>
                <div class="col-md-4">
                    <input id="productName" name="productName" type="text" class="form-control input-md" required>
                </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="priceProduct">Cena proizvoda</label>
                <div class="col-md-4">
                    <input id="productPrice" name="productPrice" type="number" class="form-control input-md" required>

                </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="productDescription">Opis-detalji proizvoda</label>
                <div class="col-md-4">
                    <input id="productDescription" name="productDescription" type="text" class="form-control input-md" required>
                </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="productGrams">Gramaža</label>
                <div class="col-md-4">
                    <input id="productGrams" name="productGrams" type="number" class="form-control input-md" required>
                </div>
            </div>
            <!-- File input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="productImage">Slika</label>
                <div class="col-md-4">
                    <input type="file"  id="productImage" name="productImage" class="form-control-file" required>
                </div>
            </div>
            <!--DropDown List-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="productCategory">Kategorija</label>
                <div class="col-md-4">
                    <select class="form-control" name="productCategory" id="productCategory" required>
                        <option value="0">Izaberite...</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
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