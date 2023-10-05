<!-- Title -->
<title>@yield('title')</title>

@yield('css')
@livewireStyles
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
@if (app()->currentlocale()=='ar')
    <!-- Favicon -->
    <link rel="icon" href="{{URL::asset('assets/img/brand/favicon.png')}}" type="image/x-icon"/>
    <!-- Icons css -->
    <link href="{{URL::asset('assets/css/icons.css')}}" rel="stylesheet">
    <!--  Custom Scroll bar-->
    <link href="{{URL::asset('assets/plugins/mscrollbar/jquery.mCustomScrollbar.css')}}" rel="stylesheet"/>
    <!--  Sidebar css -->
    <link href="{{URL::asset('assets/plugins/sidebar/sidebar.css')}}" rel="stylesheet">
    <!-- Sidemenu css -->
    <link rel="stylesheet" href="{{URL::asset('assets/css-rtl/sidemenu.css')}}">
    @yield('css')
    <!--- Style css -->
    <link href="{{URL::asset('assets/css-rtl/style.css')}}" rel="stylesheet">
    <!--- Dark-mode css -->
    <link href="{{URL::asset('assets/css-rtl/style-dark.css')}}" rel="stylesheet">
    <!---Skinmodes css-->
    <link href="{{URL::asset('assets/css-rtl/skin-modes.css')}}" rel="stylesheet">
@else
    <!-- Favicon -->
    <link rel="icon" href="{{URL::asset('assets/img/brand/favicon.png')}}" type="image/x-icon"/>
    <!-- Icons css -->
    <link href="{{URL::asset('assets/css/icons.css')}}" rel="stylesheet">
    <!--  Custom Scroll bar-->
    <link href="{{URL::asset('assets/plugins/mscrollbar/jquery.mCustomScrollbar.css')}}" rel="stylesheet"/>
    <!--Right-sidemenu css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sidebar/sidebar.css') }}">
    <!-- Sidemenu css -->
    <link rel="stylesheet" href="{{URL::asset('assets/css/sidemenu.css')}}">
    <!--  Maps css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/jqvmap/jqvmap.min.css') }}">
    <!--  style css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/style-dark.css') }}">
    <!--  Skinmodes  css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/css/skin-modes.css') }}">
@endif
