@extends('layouts.restaurantLayout')

@section('title')
    <title>{{session()->get('restaurant')->name}} | Promena proizvoda</title>
@endsection

@section('main')
    <form class="form-horizontal" action="{{asset('/restaurant/final-update-product/'.$updateProduct->id)}}" method="post" enctype="multipart/form-data" style="background-color: white;">
        {{csrf_field()}}
        <fieldset>
            <!-- Form Name -->
            <legend align="center">Promena proizvoda</legend>
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
                <label class="col-md-4 control-label" for="newProductName">Novo ime proizvoda</label>
                <div class="col-md-4">
                    <input id="newProductName" name="newProductName" type="text" class="form-control input-md" value="{{$updateProduct->name}}" required>
                </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="newPriceProduct">Nova cena proizvoda</label>
                <div class="col-md-4">
                    <input id="newProductPrice" name="newProductPrice" type="text" class="form-control input-md" value="{{$updateProduct->price}}" required>

                </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="newProductDescription">Novi opis-detalji proizvoda</label>
                <div class="col-md-4">
                    <input id="newProductDescription" name="newProductDescription" type="text" class="form-control input-md" value="{{$updateProduct->description}}" required>
                </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="newProductGrams">Nova gramaža</label>
                <div class="col-md-4">
                    <input id="newProductGrams" name="newProductGrams" type="text" class="form-control input-md" value="{{$updateProduct->grams}}" required>
                </div>
            </div>
            <!-- File input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="newProductImage">Nova slika</label>
                <div class="col-md-4">
                    <input type="file"  id="newProductImage" name="newProductImage" class="form-control-file" value="">
                </div>
            </div>
            <!--DropDown List-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="newProductCategory">Nova kategorija</label>
                <div class="col-md-4">
                    <select class="form-control" name="newProductCategory" id="productCategory" required>
                        <option value="{{$updateProduct->category_id}}">{{$updateProduct->category_name}}</option>
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