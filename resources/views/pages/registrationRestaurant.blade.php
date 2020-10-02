@extends('layouts.userLayout')

@section('title')
    <title>RBG | Registracija restoran</title>
@endsection

@section('sidebar_summary')
    @include('components.socialNetworks')
@endsection


@section('section_bottom')
    <div class="section-block registrationBackground">
        <div class="container" style="height: 80%">
            <div class="note">
                <p>Registrujte Vaš restoran i povećajte prodaju</p>
            </div>
            @if(count($errors)>0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </div>
            @endif
            <form method="post" accept-charset="UTF-8" action="{{asset('/restaurant/registration')}}" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-content">
                    <div class="row">
                        <div class="col-md-6">
                            Ime Restorana<b class="registrationStar">*</b>:
                            <div class="form-group">
                                <input type="text" class="form-control registrationInput" placeholder="Ime" required name="restaurantName"/>
                            </div>
                            Opis restorana<b class="registrationStar">*</b>:
                            <div class="form-group">
                                <input type="text" class="form-control registrationInput" placeholder="kuvana jela, pica..." required name="description"/>
                            </div>
                            E-mail<b class="registrationStar">*</b>:
                            <div class="form-group">
                                <input type="text" class="form-control registrationInput" placeholder="Email" required name="mail"/>
                            </div>
                            Lozinka<b class="registrationStar">*</b>:
                            <div class="form-group">
                                <input type="password" class="form-control registrationInput" placeholder="Lozinka" required name="password"/>
                            </div>

                            Opština Restorana<b class="registrationStar">*</b>:
                            <div class="form-group">
                                <input type="text" class="form-control registrationInput"  placeholder="Opština restorana" required name="locationRestaurant"/>
                            </div>

                            Tipovi proizvoda<b class="registrationStar">*</b>:
                            <div class="form-group"style="width: 400px;">
                                @foreach($categories as $category)
                                    <input type="checkbox" style="width:20px;height: 15px;" value="{{$category->id}}"name="chbProducts[]"/>
                                    <label>{{$category->name}}</label>
                                @endforeach
                            </div><br>
                        </div>
                        <div class="col-md-6">
                            Cena dostave<b class="registrationStar">*</b>:
                            <div class="form-group">
                                <input type="text" class="form-control registrationInput"  placeholder="Cena dostave" required name="deliveryCost"/>
                            </div>
                            Minimum za kućnu dostavu<b class="registrationStar">*</b>:
                            <div class="form-group">
                                <input type="text" class="form-control registrationInput"  placeholder="Minimum za dostavu" required name="deliveryMinimum"/>
                            </div>

                            Vreme dostave<b class="registrationStar">*</b>:
                            <div class="form-group">
                                <input type="text" class="form-control registrationInput"  placeholder="Vreme dostave" required name="deliveryTime"/>
                            </div>
                            Kuhinja restorana<b class="registrationStar">*</b>:
                            <div class="form-group">
                                <select name="kitchen" class="form-control">
                                    @foreach($kitchens as $kitchen)
                                    <option value="{{$kitchen->id}}">{{$kitchen->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            Profilna Slika Restorana<b class="registrationStar">*</b>:
                            <div class="form-group">
                                <input type="file" class="form-control registrationInput" required name="picture"/>
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