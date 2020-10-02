@extends('layouts.restaurantLayout')

@section('title')
    <title>{{session()->get('restaurant')->name}} | Brisanje posla</title>
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
                <legend align="center">Tabela poslova</legend>
                <table class="table text-center table-bordered">
                    <thead>
                    <tr>
                        <th class="text-center">Pozicija</th>
                        <th class="text-center">Plata</th>
                        <th class="text-center">Uslovi prijave</th>
                        <th class="text-center">Zaduženja</th>
                        <th class="text-center">Nudimo</th>
                        <th class="text-center">Akcija</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($jobs as $deleteJob)
                        <tr>
                            <td style="padding-top: 30px">
                                {{$deleteJob->title}}
                            </td>
                            <td style="padding-top: 30px">
                                {{$deleteJob->wage}} rsd
                            </td>
                            <td>
                                {{$deleteJob->requirements}}
                            </td>
                            <td>
                                {{$deleteJob->work_description}}
                            </td>

                            <td>
                                {{$deleteJob->our_offer}}
                            </td>
                            <td style="padding-top: 40px">
                                <a href="{{asset('/restaurant/delete-job/'.$deleteJob->id)}}">
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