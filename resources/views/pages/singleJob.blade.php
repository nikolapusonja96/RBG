@extends('layouts.userLayout')

@section('title')
    <title>RBG | Posao</title>
@endsection

@section('sidebar_section')
<div class="section-block">
    <h1 class="section-title">Detalji oglasa:</h1>
    <ul>
        <li>
            <img src="{{asset('/img/revenue.png')}}" alt="wage_icon" width="20" height="20"/>
            <b>{{$job->wage}}</b>
        </li>
        <li>
            <img src="{{asset('/img/calendar.png')}}" alt="calendar_icon" width="20" height="20"/>
            Postavljeno <b>{{$job->added_at}}</b>
        </li>
        <li>
            <img src="{{asset('/img/dining-table.png')}}" alt="table_icon" width="20" height="20"/>
            Postavio <a href="{{asset('/restaurants/'.$job->restaurant_id)}}"><b>{{$job->name}}</b></a>
        </li>
        <li>
            <img src="{{asset('/img/gps.png')}}" alt="gps_icon" width="20" height="20"/>
            <b>Beograd</b>
        </li>
    </ul>
</div>
@endsection

@section('section_bottom')
<div class="section-block">
    <div class="tab-content">
        @if(session()->has('message'))
            <div class="alert alert-success">
                <button type="button" class="close" style="height: 20px;" data-dismiss="alert">x</button>
                {{session()->get('message')}};
            </div>
        @endif
        <div role="tabpanel" class="tab-pane active" id="restorani">
            <div class="update-information">
                <!--update items-->
                <h1 class="section-title align-center" style="color:dodgerblue">{{$job->title}}</h1><br>
                <div class="container">
                    <div class="row">
                        <div id="products" class="row view-group">
                            <div class="item col-xs-4 col-lg-4">
                                <b>Uslovi:</b>
                                <li>{{$job->requirements}}</li><br><br>

                                <b>Opis radnog mesta:</b>
                                <li>{{$job->work_description}}</li><br><br>

                                <b>Nudimo:</b>
                                <li>{{$job->our_offer}}</li>
                            </div>
                        </div><br><br>
                        <hr width="60%">
                        @if(session()->has('user') &&  $userSingleJob == null)
                        <a href="{{asset('/application/'.$job->job_id)}}">
                            <button class="btn btn-primary" style="width: 60%">
                                Konkuriši
                            </button>
                        </a>
                        @elseif(session()->has('user') && session()->get('user')->UID == $userSingleJob->user_id)
                            <i class="btnDisabled">
                                <button class="btn btn-primary btnJobApply" disabled>Konkuriši</button>
                                <span class="tooltip-disabledSingleJobBtn">Vec ste aplicirali ({{$userSingleJob->applied_at}})</span>
                            </i>
                        @else
                        <i class="btnDisabled">
                            <button class="btn btn-primary btnJobApply" disabled>Konkuriši</button>
                            <span class="tooltip-disabledSingleJobBtn">Morate biti ulogovani da biste konkurisali</span>
                        </i>
                        @endif
                    </div>
                </div>
                <!--/update items-->
            </div>
        </div>
    </div>
</div>
@endsection


@section('sidebar_summary')
    @include('components.socialNetworks')
@endsection