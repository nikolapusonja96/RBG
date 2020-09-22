@extends('layouts.userLayout')
@section('title')
    <title>RBG | Naručivanje</title>
@endsection
@section('section_bottom')
    <div class="section-block">
        <!-- container -->
{{--        <div class="container">--}}
            <!-- row -->
            <div class="row">
                <form action="{{asset('/post-checkout')}}" method="post" id="checkout-form" class="clearfix">
                    {{csrf_field()}}
                    <div class="col-md-6">
                        <div class="billing-details">
                            <div class="section-title">
                                <h3 class="title">Detalji porudžbine</h3>
                                <i class="RedStar">Polja obeležena sa <b class="registrationStar">*</b> su obavezna</i>
                            </div>

                            Ime<b class="registrationStar">*</b>:
                            <div class="form-group">
                                <input type="text" class="checkoutInput form-control registrationInput" disabled value="{{session()->get('user')->first_name}}" name="first-name"/>
                            </div>
{{--                            {{dd(session()->get('user'))}}--}}
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
                                    <th>Cena </th>
                                    <th colspan="2" class="sub-total">{{$total}} RSD</th>
{{--                                    {{dd(session()->get('cart')->items['1']['item'])}}--}}
                                </tr>
                                <tr>
                                    <th class="empty" colspan="3"></th>
                                    <th>Dostava</th>
                                    <td colspan="2">
                                        <b>{{session()->get('cart')->items[$idRestaurant]['item']->delivery_cost}} RSD</b>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="empty" colspan="3"></th>
                                    <th>Ukupna cena narudžbine</th>
                                    <th colspan="2" class="total">{{$total + session()->get('cart')->items[$idRestaurant]['item']->delivery_cost}} RSD</th>
                                </tr>
                                </tfoot>
                            </table>
                            <div class="pull-right">
                                <input type="submit" value="Naruči" class="primary-btn" style="width:510px;">
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <!-- /row -->
{{--        </div>--}}
        <!-- /container -->
{{--    </div>--}}
    </div>
    <!-- /section -->
@endsection
@section('sidebar_summary')
    @include('components.socialNetworks')
@endsection