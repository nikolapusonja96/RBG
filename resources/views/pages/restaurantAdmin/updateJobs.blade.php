@extends('layouts.restaurantLayout')

@section('title')
    <title>{{session()->get('restaurant')->name}} | Promena podataka posla</title>
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
{{--                    {{dd($jobs)}}--}}
                    @foreach($jobs as $updateJob)
                        <tr>
                            <td style="padding-top: 30px">
                                {{$updateJob->title}}
                            </td>
                            <td style="padding-top: 30px">
                                {{$updateJob->wage}} rsd
                            </td>
                            <td>
                                {{$updateJob->requirements}}
                            </td>
                            <td>
                                {{$updateJob->work_description}}
                            </td>

                            <td>
                                {{$updateJob->our_offer}}
                            </td>
                            <td style="padding-top: 40px">
                                <a href="{{asset('/restaurant/update-job-info/'.$updateJob->id)}}">
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