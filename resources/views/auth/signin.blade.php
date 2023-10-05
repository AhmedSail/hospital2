@extends('Dashboard.layouts.master2')
@section('css')
    <style>
        .panel {
            display: none;
        }
    </style>
    <!-- Sidemenu-respoansive-tabs css -->
    <link href="{{ URL::asset('assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css') }}"
        rel="stylesheet">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row no-gutter">
            <!-- The image half -->
            <div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
                <div class="row wd-100p mx-auto text-center">
                    <div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
                        <img src="{{ URL::asset('assets/img/media/login.png') }}"
                            class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
                    </div>
                </div>
            </div>
            <!-- The content half -->
            <div class="col-md-6 col-lg-6 col-xl-5 bg-white">
                <div class="login d-flex align-items-center py-2">
                    <!-- Demo content-->
                    <div class="container p-0">
                        <div class="row">
                            <div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
                                <div class="card-sigin">
                                    <div class="mb-5 d-flex"> <a href="{{ url('/' . ($page = 'index')) }}"><img
                                                src="{{ URL::asset('assets/img/brand/favicon.png') }}"
                                                class="sign-favicon ht-40" alt="logo"></a>
                                        <h1 class="main-logo1 ml-1 mr-0 my-auto tx-28">Va<span>le</span>x</h1>
                                    </div>
                                    <div class="card-sigin">
                                        <div class="main-signup-header">
                                            <h2>{{ __('main.Welcome Back') }}</h2>
                                            <h5 class="font-weight-semibold mb-4">
                                                {{ __('main.Please sign in to continue') }}</h5>
                                            <div class="form-group ">
                                                <label>{{ __('main.Select the login method') }}</label>
                                                <select class="form-select form-control mb-3 select"
                                                    aria-label="Default select example" id="sectionChooser">
                                                    <option style="color: #A5A0B1" selected disabled>
                                                        {{ __('main.Select from list') }}</option>
                                                    <option value="patient">{{ __('main.Patient') }}</option>
                                                    <option value="admin">{{ __('main.Admin') }}</option>
                                                    <option value="doctor">{{ __('main.Doctor') }}</option>
                                                    <option value="ray_employee">{{ __('main.Ray Employee') }}</option>
                                                    <option value="laboratory_employee">
                                                        {{ __('main.Laboratory Employee') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End -->
                </div>
            </div><!-- End -->
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('#sectionChooser').change(function() {
            var myID = $(this).val();

            if (myID === 'admin') {
                window.location.href = '{{ route('admin_login') }}'; // توجيه إلى صفحة تسجيل دخول الإداري
            } else if (myID === 'patient') {
                window.location.href = '{{ route('patient_login') }}'; // توجيه إلى صفحة تسجيل دخول المريض
            } else if (myID === 'doctor') {
                window.location.href = '{{ route('doctor_login') }}'; // توجيه إلى صفحة تسجيل دخول الطبيب
            } else if (myID === 'ray_employee') {
                window.location.href ='{{ route('ray_employee_login') }}'; // توجيه إلى صفحة تسجيل دخول موظف الأشعة
            } else if (myID === 'laboratory_employee') {
                window.location.href ='{{ route('laboratory_employee_login') }}'; // توجيه إلى صفحة تسجيل دخول موظف المختبر
            } else {
                $('.panel').each(function() {
                    myID === $(this).attr('id') ? $(this).show() : $(this).hide();
                });
            }
        });
    </script>
@endsection
