@extends('layouts.userLayout')

@section('title')
    <title>RBG | registracija</title>
@endsection

@section('sidebar_summary')
    @include('components.socialNetworks')
@endsection

@section('sidebar_section')
    <div class="regRestaurants">
        <div class="note_sidebar">
            <a href="{{asset('/restaurant/registration')}}">
                <p>Registrujte Vaš restoran</p>
            </a>
        </div>
    </div>
@endsection

@section('section_bottom')
<div class="section-block registrationBackground">
    <div class="container register-form">
        <div class="note">
            <p>Registrujte se</p>
        </div>
        @if(count($errors)>0)
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </div>
        @endif
        <form method="post" accept-charset="UTF-8" action="{{asset('/registration')}}">
            {{csrf_field()}}
            <div class="form-content">
                <div class="row">
                    <div class="col-md-6">
                        Ime<b class="registrationStar">*</b>:
                        <div class="form-group">
                            <input type="text" class="form-control registrationInput" placeholder="Ime" required name="firstName"/>
                        </div>
                        E-mail<b class="registrationStar">*</b>:
                        <div class="form-group">
                            <input type="text" class="form-control registrationInput" placeholder="Email" required name="mail"/>
                        </div>
                        Adresa<b class="registrationStar">*</b>:
                        <div class="form-group">
                            <input type="text" class="form-control registrationInput" placeholder="Adresa" required name="address"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        Prezime<b class="registrationStar">*</b>:
                        <div class="form-group">
                            <input type="text" class="form-control registrationInput"  placeholder="Prezime" required name="lastName"/>
                        </div>
                        Lozinka<b class="registrationStar">*</b>:
                        <div class="form-group">
                            <input type="password" class="form-control registrationInput" placeholder="Lozinka" required name="password"/>
                        </div>
                        Pol:
                        <div class="form-group">
                            <input type="radio" name="gender" value="Muški">Muški<br>
                            <input type="radio" name="gender" value="Ženski">Ženski
                        </div>
                    </div>
                </div>
                Polja obeležena sa <b class="registrationStar">*</b> su obavezna<br>
                <button type="submit" class="btnSubmit">Registracija</button>
            </div>
        </form>
    </div>
</div>
@endsection