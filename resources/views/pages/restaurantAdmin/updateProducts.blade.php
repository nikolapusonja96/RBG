@extends('layouts.restaurantLayout')

@section('title')
    <title>{{session()->get('restaurant')->name}} | Promena proizvoda</title>
@endsection

@section('main')
<div class="row">
    <div style="background-color: white;" >
        @if(session()->has('message'))
        <div class="alert alert-success" align="center">
            <button type="button" class="close" data-dismiss="alert">x</button>
            {{ session()->get('message') }}
        </div>
        @endif
        <fieldset>
            <legend align="center">Tabela proizvoda</legend>
            <table class="table text-center table-bordered">
                <thead>
                <tr>
                    <th class="text-center">Slika</th>
                    <th class="text-center">Ime proizvoda</th>
                    <th class="text-center">Cena proizvoda</th>
                    <th class="text-center">Grama</th>
                    <th class="text-center">Opis proizvoda</th>
                    <th class="text-center">Kategorija</th>
                    <th class="text-center">Akcija</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $updateProduct)
                    <tr>
                        <td>
                            <img src="{{asset($updateProduct->img)}}"  alt="{{$updateProduct->description}}" width="90" height="60"/>
                        </td>
                        <td style="padding-top: 30px">
                            {{$updateProduct->name}}
                        </td>
                        <td style="padding-top: 30px">
                            {{$updateProduct->price}} rsd
                        </td>
                        <td style="padding-top: 30px">
                            {{$updateProduct->grams}}
                        </td>
                        <td style="padding-top: 30px">
                            {{$updateProduct->description}}
                        </td>
                        <td style="padding-top: 30px">
                            {{$updateProduct->category_name}}
                        </td>
                        <td style="padding-top: 20px">
                            <a href="{{asset('/restaurant/update-product/'.$updateProduct->id)}}">
                                <button class="btn btn-primary">Promeni</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </fieldset>
    </div>
</div>
@endsection