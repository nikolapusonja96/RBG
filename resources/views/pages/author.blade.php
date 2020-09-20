@extends('layouts.userLayout')

@section('title')
    <title>RBG | Autor</title>
@endsection

@section('section_top')
    <div class="section-block">
        <div class="funding-meta">
            <img src="{{asset('/img/cv1.png')}}" style="width: 270px; margin-left: 220px; height:370px;" alt="author_img"/>
        </div>
    </div>
@endsection

@section('sidebar_section')
<div class="section-block">
    <h1 class="section-title">O autoru</h1>

    <p style="margin-top: 10px; font-style: italic; font-weight: bold;">Pozdrav, moje ime je Nikola Pušonja. Završio sam VI Beogradsku gimnaziju, sada sam na završnoj godini Visoke ICT škole.
        Ovaj sajt je rađen u svrhu završnog rada.<br><br>Moj e-mail: n.pule96@gmail.com<br><br>
        <i style="text-decoration: underline; text-decoration-color: darkorange">Disclaimer:</i> I do not own images on this website. I used it in educational purposes.
    </p>
</div>
@endsection
@section('sidebar_summary')
    <div class="profile-contents">
        <h2 class="position">Društvene mreže</h2>
        <!--social links-->
        <ul class="list-inline">
            <li><a href="https://www.facebook.com/puleta96"><i class="fa fa-facebook"></i></a></li>
            <li><a href="https://www.linkedin.com/in/nikola-pusonja/"><i class="fa fa-linkedin"></i></a></li>
            <li><a href="https://github.com/nikolapusonja96"><i class="fa fa-git"></i></a></li>
        </ul>
        <!--/social links-->

    </div>
@endsection