<nav id="menu">
    <ul class="links">
        @foreach($menus as $menu)
            <li>
                <a href="{{asset($menu->path)}}">{{$menu->name}}</a>
            </li>
        @endforeach
    </ul>
    <ul class="actions vertical">
        <li>
            <a href="#" class="button fit">Login</a>
        </li>
    </ul>
</nav>
