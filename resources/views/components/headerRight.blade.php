<nav class="right">
    <a href="{{asset('/cart')}}">
        <div class="header-btns-icon" style="margin-right: 20px; width: 50px;">
            <i class="fa fa-shopping-cart" style="font-weight: normal;">
                <span class="pull-right" style="font-size: 21px;margin-left: 40px;margin-top: -23px;">
                    &nbsp;&nbsp;{{session()->has('cart') ? session()->get('cart')->totalQty : 0}}
                </span>
            </i>
        </div>
    </a>
    @if(!session()->has('user'))
{{--    <a href="{{asset('/login')}}" class="button alt">Prijava</a>--}}
        <a class="button alt" id="myBtn">Prijava</a>

        <!-- The Modal -->
        <div id="myModal" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
                <span class="closeModal">&times;</span>
                    <a href="{{asset('/login')}}" class="button alt modal-content-btn">Kao Korisnik</a>
                    <a href="{{asset('/login-restaurant')}}" class="button alt modal-content-btn">Kao Restoran</a>
            </div>

        </div>
    <a href="{{asset('/registration')}}" class="button alt">Registracija</a>
        @else
        <b> {{session()->get('user')->first_name}}&nbsp;{{session()->get('user')->last_name}}</b>
    @endif
</nav>
