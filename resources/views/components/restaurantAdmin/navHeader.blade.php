<nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
    @if(session()->has('restaurant'))
    <div class="navbar-header">
        <a class="navbar-brand" href="{{asset('/restaurant-profile')}}">{{session()->get('restaurant')->name}}</a>
    </div>
    @else
    <div class="navbar-header">
        <a class="navbar-brand" href="{{asset('/admin')}}">Admin Panel</a>
    </div>
    @endif
    @if(session()->has('restaurant'))
    <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;">
        <a href="{{asset('/restaurant/logout')}}" class="btn btn-danger square-btn-adjust">Odjava</a>
    </div>
    @else
    <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;">
        <a href="{{asset('/admin/logout')}}" class="btn btn-danger square-btn-adjust">Odjava</a>
    </div>
    @endif
</nav>
