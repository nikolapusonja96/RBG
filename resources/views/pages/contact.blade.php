@extends('layouts.userLayout')

@section('title')
    <title>RBG | kontakt</title>
@endsection

@section('sidebar_summary')
    @include('components.socialNetworks')
@endsection

@section('sidebar_section')
<div class="section-block">
    <h1 class="section-title">Restorani Beograd - RBG</h1>
    <h4>
        <strong>
            <span> RBG kancelarija - Savska 2, 11000 Beograd, Srbija</span>
        </strong>
    </h4><br>
    <h5>Korisnička podrška 10-23h</h5>
    Tel: <strong>+38163/43-54-11 </strong>ili <strong>+38162/434-12-323</strong><br>
    Mail: <strong>rbg@gmail.com</strong>
</div>
@endsection

@section('section_top')
    <div class="container">
        <div class="row">
            @if($message = session()->get('message'))
                <div class="alert alert-success" style="width: 50%">
                    {{ session()->get('message') }}
                </div>

            @endif
            <div class="col-sm-9 col-lg-9">
                <h2 style="color: #85AD90">
                    Kontaktirajte nas<br>
                </h2>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="well well-sm" style="border-radius: 15px">

                    <form method="post" action="{{asset('contact/sendmail')}}">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">
                                        Ime</label>
                                    <input type="text" class="form-control" name="mail_customer_firstname" id="mail_customer_firstname" placeholder="Unesite ime" required="required" />
                                </div>
                                <div class="form-group">
                                    <label for="name">
                                        Prezime</label>
                                    <input type="text" class="form-control" name="mail_customer_lastname" id="mail_customer_lastname" placeholder="Unesite prezime" required="required" />
                                </div>
                                <div class="form-group">
                                    <label for="email">
                                        Email Adresa</label>
                                    <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                </span>
                                        <input type="email" class="form-control"  name="mail_customer_email"  id="email" placeholder="Unesite email" required="required" /></div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Poruka</label>
                                    <textarea name="mail_customer_message"  id="message" class="form-control" rows="9" cols="25" required="required" placeholder="Vaša Poruka"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary pull-right" id="btnContactUs" style="background-color: #4cae4c">
                                    Pošalji
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection