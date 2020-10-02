<nav id="menu">
    <ul class="links">
        @foreach($menus as $menu)
            <li>
                <a href="{{asset($menu->path)}}">{{$menu->name}}</a>
            </li>
        @endforeach
    </ul>
    @if(!session()->has('user'))
    <ul class="actions vertical">
        <li>
            <a href="#" class="button fit">Login</a>
        </li>
    </ul>
    @else
        <ul class="actions vertical links">

            <li>
                <a href="#" class="button fit">{{session()->get('user')->first_name}} {{session()->get('user')->last_name}}</a>
            </li>
            <li>
                <a href="{{asset('/user-profile')}}">
                    Profil
                </a>
            </li>
            <li>
                <a href="{{asset('/user-orders')}}">
                    Porudžbine
                </a>
            </li>
            <li>
                <a href="{{asset('/liked-restaurants')}}">
                    Moji Restorani
                </a>
            </li>
        </ul>
   @endif
</nav>
