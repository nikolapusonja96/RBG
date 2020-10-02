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
                <legend align="center">Tabela Kuhinja</legend>
                <table class="table text-center table-bordered">
                    <thead>
                    <tr>
                        <th class="text-center">Id</th>
                        <th class="text-center">Ime Kuhinje</th>
                        <th class="text-center">Akcija</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($kitchens as $kitchen)
                        <tr>
                            <td>
                                {{$kitchen->id}}
                            </td>
                            <td>
                                {{$kitchen->name}}
                            </td>
                            <td>
                                @if($kitchen->id == 1)
                                <a href="#" style="cursor: not-allowed">
                                    <button class="btn btn-primary" disabled>Obriši</button>
                                </a>
                                @else
                                <a href="{{asset('/admin/delete-kitchen/'.$kitchen->id)}}">
                                    <button class="btn btn-primary">Obriši</button>
                                </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </fieldset>
        </div>
    </div>
@endsection