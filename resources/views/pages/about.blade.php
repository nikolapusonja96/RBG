@extends('layouts.userLayout')

@section('title')
    <title>RBG | O nama</title>
@endsection

@section('section_bottom')
    <!--tabs-->
    <div class="section-block">
        <div class="section-tabs">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#about" aria-controls="about" role="tab" data-toggle="tab">O nama</a></li>
                <li role="presentation" ><a href="#whyUs" aria-controls="whyUs" role="tab" data-toggle="tab">Zašto mi?</a></li>
                <li role="presentation"><a href="#questions" aria-controls="updates" role="tab" data-toggle="tab">Najčešća pitanja</a></li>
            </ul>
        </div>
    </div>
    <!--/tabs-->
    <!--tab panes-->
    <div class="section-block">
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="about">
                <div class="about-information">
                    <h1 class="section-title">RestoraniBG - Restorani Beograd</h1>
                    <p>Restorani Beograd je upravo ono što onlajn naručivanje hrane čini brzim i jednostavnim!
                    <h3>Šta to mi radimo?</h3>
                        Samo dve stvari, ali ih radimo vrhunski:

                        Našim korisnicima pružamo brzo, jednostavno i standardizovano naručivanje hrane putem interneta.
                        A za objekte otvaramo potpuno novi i nezavisni kanal prodaje, bez dodatnih troškova i rizika. Sve je spremno za 48 sati.
                    </p>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane " id="whyUs">
                <div class="update-information">
                    <button class="resume">1. Možete poručiti hranu</button>
                    <button class="resume">2. Možete aplicirati za posao</button>
                    <button class="resume">3. Najbolji restorani</button>
                    <button class="resume">4. Sve je online</button>
                    <button class="resume">5. Brza dostava</button>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="questions">
                <div class="update-information">
                    <!--update items-->

                    <!--/update items-->
                    <button class="accordion">1. Kako da naručim hranu?</button>
                    <div class="panel">
                        <p style="color:black;">Izaberite jedan od restorana koji Vam se dopada i dodajte proizvode u korpu.
                            Kada završite vašu narudžbinu, jednostavno kliknite na naruči i ona se automatski šalje u restoran.</p>
                    </div>

                    <button class="accordion">2. Kada će stići moja narudžbina?</button>
                    <div class="panel">
                        <p style="color:black;">Svaki restoran ima svoje unapred definisano vreme maksimalne dostave.</p>
                    </div>

                    <button class="accordion">3. Šta ako želim da promenim ili otkažem narudžbinu?</button>
                    <div class="panel">
                        <p style="color:black;">Potrebno je da direktno kontaktirate objekat i to će zavisiti od faze pripreme vaše narudžbine. Što pre nazovete, veća je verovatnoća da ćete na vreme izvršiti promene koje želite.</p>
                    </div>
                    <button class="accordion">4. Da li moram da platim više ako naručim preko RBG servisa?</button>
                    <div class="panel">
                        <p style="color:black;">RBG je za korisnike potpuno besplatan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('sidebar_section')
<div class="section-block">
    <div class="window">
        <div class="containerSlider">
            @foreach($smallSlider as $slider)
                <img class="slider"  src="{{asset($slider->path)}}" alt="{{$slider->alt}}">
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('sidebar_summary')
    @include('components.socialNetworks')
@endsection