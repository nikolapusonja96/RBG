<div class="content col-md-4 col-sm-12 col-xs-12">
{{--    <div class="section-block">--}}
        @yield('sidebar_headline')
        <!--sidebar blocks-->
       @yield('sidebar_section')
        <!--/sidebar blocks-->
{{--    </div>--}}
    @include('components.sidebarSummary')
</div>
