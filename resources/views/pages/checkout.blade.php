@extends('layouts.userLayout')
@section('title')
    <title>RBG | Naručivanje</title>
@endsection
@section('section_bottom')
    <div class="section-block">
            <div class="row">
                <form action="{{asset('/post-checkout')}}" method="post" id="checkout-form" class="clearfix">
                    {{csrf_field()}}
                    <div class="col-md-6">
                        <div class="billing-details">
                            @if(count($errors)>0)
                                <div class="alert alert-danger">
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </div>
                            @endif
{{--                            {{dd($restaurant)}}--}}
                            <div class="section-title">
                                <h3 class="title">Detalji porudžbine</h3>
                                <i class="RedStar">Polja obeležena sa <b class="registrationStar">*</b> su obavezna</i>
                            </div>
                            Ime<b class="registrationStar">*</b>:
                            <div class="form-group">
                                <input type="text" class="checkoutInput form-control registrationInput" disabled value="{{session()->get('user')->first_name}}" name="first-name"/>
                            </div>
                            Prezime<b class="registrationStar">*</b>:
                            <div class="form-group">
                                <input type="text" class="checkoutInput form-control registrationInput" disabled value="{{session()->get('user')->last_name}}" name="last-name"/>
                            </div>
                            Adresa dostave<b class="registrationStar">*</b>:
                            <div class="form-group">
                                <input type="text" class="form-control registrationInput" required name="address"/>
                            </div>
                            Telefon<b class="registrationStar">*</b>:
                            <div class="form-group">
                                <input type="text" class="form-control registrationInput" required name="phone"/>
                            </div>
                        </div>
                    </div><br><br>
                    <div class="col-md-9">
                        <div class="order-summary">

                            <table class="shopping-cart-table table">
                                <tfoot>
                                <tr>
                                    <th class="empty" colspan="3"></th>
                                    <th>Cena obroka</th>
                                    <th colspan="2" class="sub-total">
                                        <i class="blueText">{{$total}} RSD</i>
                                    </th>
                                </tr>
                                <tr>
                                    <th class="empty" colspan="3"></th>
                                    <th>Cena dostave</th>
                                    <td colspan="2">
                                        <b>
                                            @if($restaurant->delivery_cost > 0)
                                            <i class="blueText">{{$restaurant->delivery_cost}} rsd</i>
                                            @else
                                                <i class="blueText">Besplatna dostava</i>
                                            @endif
                                        </b>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="empty" colspan="3"></th>
                                    <th>Minimum za kućnu dostavu</th>
                                    <td colspan="2">
                                        <b>
                                            <i class="blueText">{{$restaurant->min_delivery}} RSD</i>
                                        </b>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="empty" colspan="3"></th>
                                    <th>Ukupna cena porudžbine</th>
                                    <th colspan="2" class="total" style="color:red;">{{$total + $restaurant->delivery_cost}} RSD</th>
                                </tr>
                                </tfoot>
                            </table>
                            <div class="pull-right">
                                @if($restaurant->min_delivery > ($total + $restaurant->delivery_cost))
                                    <i class="btnDisabled">
                                        <a href="{{'/restaurants/'.$restaurant->id}}">Nazad na meni</a>
                                <input type="submit" value="Naruči" class="primary-btn" style="width:510px;" disabled >
                                        <span class="tooltip-disabledBtn">Fali Vam još {{$restaurant->min_delivery - ($total + $restaurant->delivery_cost)}} rsd za dostavu </span>
                                    </i>
                                @else
                                <input type="submit" value="Naruči" class="primary-btn" style="width:510px; background-color: dodgerblue">
                                @endif
                            </div>
                        </div>

                    </div>
                </form>
            </div>
    </div>
@endsection
@section('sidebar_summary')
    @include('components.socialNetworks')
@endsection