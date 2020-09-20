<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

<head>
@include('components.head')
@yield('title')
</head>

<body>
<!-- Header -->
@include('components.header')

<!-- Menu -->
@include('components.menuLinks')
<!--/header-->

<!--main content-->
@include('components.content')

<footer class="footer">
    @include('components.footer')
</footer>

<!-- Scripts -->
@include('components.scripts')

</body>
</html>

