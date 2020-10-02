@extends('layouts.restaurantLayout')

@section('title')
    <title>RBG | Admin Panel</title>
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
                <legend align="center">Tabela Komentara</legend>
                <table class="table text-center table-bordered">
                    <thead>
                    <tr>
                        <th class="text-center">Id</th>
                        <th class="text-center">Tekst komentara</th>
                        <th class="text-center">Datum postavljanja</th>
                        <th class="text-center">Akcija</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($comments as $comment)
                        <tr>
                            <td>
                                {{$comment->id}}
                            </td>
                            <td>
                                {{$comment->text}}
                            </td>
                            <td>
                                {{$comment->time}}
                            </td>
                            <td>
                                <a href="{{asset('/admin/delete-comment/'.$comment->id)}}">
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
