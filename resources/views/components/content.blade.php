<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="content col-md-8 col-sm-12 col-xs-12">
                @yield('section_top')
                @yield('section_bottom')
            </div>
            <!--sidebar-->
        @include('components.sidebar')
        <!--/sidebar-->
        </div>
    </div>
</div>
