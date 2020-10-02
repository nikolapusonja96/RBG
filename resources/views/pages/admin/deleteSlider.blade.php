@extends('layouts.restaurantLayout')

@section('title')
    <title>Admin Panel | Brisanje slajder slika</title>
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
                <legend align="center">Tabela Slika Slajder</legend>
                <table class="table text-center table-bordered">
                    <thead>
                    <tr>
                        <th class="text-center">Id</th>
                        <th class="text-center">Slika</th>
                        <th class="text-center">Tip slajdera</th>
                        <th class="text-center">Akcija</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sliderImages as $image)
                        <tr>
                            <td>
                                {{$image->id}}
                            </td>
                            <td>
                                <img src="{{asset($image->path)}}"  alt="{{$image->alt}}" width="90" height="60"/>
                            </td>
                            <td>
                                {{$image->type}}
                            </td>
                            <td>
                                <a href="{{asset('/admin/delete-slider/'.$image->id)}}">
                                    <button class="btn btn-primary">Obriši</button>
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
