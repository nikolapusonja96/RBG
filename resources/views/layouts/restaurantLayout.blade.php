<!DOCTYPE html>
<html lang="http://www.w3.org/1999/xhtml">
<head>
    @yield('title')
    @include('components.restaurantAdmin.head')
</head>
<body>

<div id="wrapper">
@include('components.restaurantAdmin.navHeader')
<!-- /. NAV TOP  -->
@include('components.restaurantAdmin.navSide')
<!-- /. NAV SIDE  -->
    <div id="page-wrapper">
        <div id="page-inner">
            @yield('main')
            <!-- /. ROW  -->
            <hr>
        </div>
        <!-- /. PAGE INNER  -->
    </div>
<!-- /. PAGE WRAPPER  -->
</div>
<!-- /. WRAPPER  -->

<!-- JQUERY SCRIPTS -->
@include('components.restaurantAdmin.scripts')

</body>
</html>
