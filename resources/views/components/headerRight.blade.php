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
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    {{session()->get('user')->first_name}} {{session()->get('user')->last_name}}
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" style="border-top:5px solid blue;"><!--  style="background-color: lightgray; opacity: 0.4;color:red;"-->
                    <li class="user-ddl-link">
                        <i class="fa fa-user fa-2x" style="margin-left: 3px"></i>
                        <a href="{{asset('/user-profile')}}">Moj profil</a>
                    </li>
                    <li class="user-ddl-link">
                        <i class="fa fa-shopping-cart fa-2x" style="margin-left: 3px"></i>
                        <a href="{{asset('/user-orders')}}">Porudžbine</a>
                    </li>
                    <li class="user-ddl-link">
                        <i class="fa fa-heart fa-2x" style="margin-left: 3px"></i>
                        <a href="{{asset('/user-liked-restaurants')}}" class="user-ddl-text">Restorani</a>
                    </li>
                    <li class="user-ddl-link">
                        <i class="fa fa-check fa-2x" style="margin-left: 3px"></i>
                        <a href="{{asset('/user-jobs')}}" class="user-ddl-text">Poslovi</a>
                    </li>
                    <li class="user-ddl-link">
                        <i class="fa fa-lock fa-2x" style="margin-left: 3px"></i>
                        <a href="{{asset('/logout')}}">Odjava</a>
                    </li>
                </ul>
            </li>
        </ul>
    @endif
</nav>