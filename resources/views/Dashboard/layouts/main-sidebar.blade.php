<!-- main-sidebar -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar sidebar-scroll">
    <div class="main-sidebar-header active">
        <a class="desktop-logo logo-light active" href="{{ url('/' . ($page = 'index')) }}"><img
                src="{{ URL::asset('assets/img/brand/logo.png') }}" class="main-logo" alt="logo"></a>
        <a class="desktop-logo logo-dark active" href="{{ url('/' . ($page = 'index')) }}"><img
                src="{{ URL::asset('assets/img/brand/logo-white.png') }}" class="main-logo dark-theme"
                alt="logo"></a>
        <a class="logo-icon mobile-logo icon-light active" href="{{ url('/' . ($page = 'index')) }}"><img
                src="{{ URL::asset('assets/img/brand/favicon.png') }}" class="logo-icon" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-dark active" href="{{ url('/' . ($page = 'index')) }}"><img
                src="{{ URL::asset('assets/img/brand/favicon-white.png') }}" class="logo-icon dark-theme"
                alt="logo"></a>
    </div>
    @if (Auth::guard('admin')->check())
        @include('Dashboard.layouts.main-sidebar.main-sidebar-admin')
    @elseif (Auth::guard('doctor')->check())
        @include('Dashboard.layouts.main-sidebar.main-sidebar-doctor')
    @elseif (Auth::guard('patient')->check())
        @include('Dashboard.layouts.main-sidebar.main-sidebar-patient')
    @elseif (Auth::guard('ray_employee')->check())
        @include('Dashboard.layouts.main-sidebar.main-sidebar-ray_employee')
    @elseif (Auth::guard('laboratory_employee')->check())
        @include('Dashboard.layouts.main-sidebar.main-sidebar-laboratory')
    @endif
</aside>
<!-- main-sidebar -->
