<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
            @if(session()->has('restaurant'))
            <li class="text-center">
                <a href="{{asset('/restaurant-profile')}}">
                    <img width="120" height="120" style="border-radius: 50%;" src="{{asset(session()->get('restaurant')->profile_pic)}}" class="user-image img-responsive" alt="restaurant panel profile pic"/>
                </a>
            </li>
            @else
            <li class="text-center">
                <a href="{{asset('/admin')}}">
                    <img width="120" height="120" style="" src="{{asset('/img/adminpanel.png')}}" class="user-image img-responsive" alt="admin panel profile pic"/>
                </a>
            </li>
            @endif

            @if(session()->has('restaurant'))
            @foreach($restaurantMenu as $menu)
                @if($menu->parent_id == 0)
                    <li class="category-nav show-on-click">
                        <a href="{{asset($menu->link_menu)}}">{{$menu->text_menu}} <i class="fa fa-angle-right"></i></a>
                        @component('components.restaurantAdmin.submenus',
                        [
                            'children' => $menu->submenus,
                            'menus' => $restaurantMenu
                        ])
                        @endcomponent
                    </li>
                @endif
            @endforeach
            @else
            @foreach($adminMenu as $menu)
                @if($menu->parent_id == 0)
                    <li class="category-nav show-on-click">
                        <a href="{{asset($menu->link)}}">{{$menu->text}} <i class="fa fa-angle-right"></i></a>
                        @component('components.restaurantAdmin.submenus',
                               [
                                   'children' => $menu->submenus,
                                   'menus' => $adminMenu
                               ])
                        @endcomponent
                    </li>
                @endif
            @endforeach
            @endif
{{--            <li class="category-nav show-on-click">--}}
{{--                <a href="#">Ja <i class="fa fa-angle-right"></i></a>--}}
{{--            </li>--}}
{{--            <li class="category-nav show-on-click">--}}
{{--                <a href="#">Ja <i class="fa fa-angle-right"></i></a>--}}
{{--            </li>--}}
{{--            <li class="category-nav show-on-click">--}}
{{--                <a href="#">Ja <i class="fa fa-angle-right"></i></a>--}}
{{--            </li>--}}
        </ul>
    </div>

</nav>

