@isset($children)
    @if(count($children)>0)
        <ul class="nav nav-second-level">
            @if(session()->has('restaurant'))
            @foreach($children as $child)
                <li>
                    <a href="{{asset($child->link_menu)}}">{{$child->text_menu}}</a>
                </li>
            @endforeach

            @elseif(session()->has('user'))
            @foreach($children as $child)
                <li>
                    <a href="{{asset($child->link)}}">{{$child->text}}</a>
                </li>
            @endforeach
            @endif
        </ul>
    @endif
@endisset
