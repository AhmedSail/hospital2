@extends('Dashboard.layouts.master')
@section('css')
    <style>
        .hand {
            animation: waving 0.8s infinite;
            /* تطبيق الأنيميشن */
        }

        @keyframes waving {
            0% {
                transform: rotate(0deg);
            }

            25% {
                transform: rotate(20deg);
            }

            50% {
                transform: rotate(0deg);
            }

            75% {
                transform: rotate(-20deg);
            }

            100% {
                transform: rotate(0deg);
            }
        }
    </style>
    <!--  Owl-carousel css-->
    <link href="{{ URL::asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet" />
    <!-- Maps css -->
    <link href="{{ URL::asset('assets/plugins/jqvmap/jqvmap.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1 d-flex">Hi {{ Auth::user()->name }}, welcome back <div
                        class="hand">👋</div>
                </h2>
                <br>
                <p class="mg-b-0">{{ __('main.Ray Employee') }}</p>
            </div>
        </div>
    </div>
    <!-- /breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-primary-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">{{ __('RayEmployee.اجمالي عدد الفواتير') }}</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ App\Models\Ray::count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-danger-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">{{ __('RayEmployee.اجمالي عدد الفواتير') }} {{ __('doctor/invoices.Under Process') }}</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ App\Models\Ray::where('case',0)->count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-success-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">{{ __('RayEmployee.اجمالي عدد الفواتير') }} {{ __('doctor/invoices.Completed') }}</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ App\Models\Ray::where('case',1)->count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
            </div>
        </div>
    </div>
    <!-- row closed -->

    <!-- row close -->

    <!-- row opened -->
    <div class="row row-sm row-deck">
        <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="card card-table-two">
                <div class="table-responsive">
                    <table style="text-align: center" class="table text-md-nowrap" id="example1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('doctor.Name') }}</th>
                                <th>{{ __('doctor.Email') }}</th>
                                <th>{{ __('doctor.Added Date') }}</th>
                                <th>{{ __('doctor.Status') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{ __('RayEmployee.Last 5 Invoices In The System') }}
                            <br>
                            @foreach(App\Models\Ray::latest()->take(5)->get() as $ray)
                                <tr>
                                    <td>{{ $loop->iteration}}</td>
                                    <td>{{ $ray->Patient->name }}</td>
                                    <td>{{ $ray->Patient->email }}</td>
                                    <td>{{ $ray->created_at }}</td>
                                    <td>
                                        @if($ray->case == 0)
                                            <span class="badge badge-danger">{{ __('doctor/invoices.Under Process') }}</span>
                                        @else
                                            <span class="badge badge-success">{{ __('RayEmployee.Completed') }}</span>
                                        @endif
                                    </td>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
    <!-- /row -->
    </div>
    </div>
    <!-- Container closed -->
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- Moment js -->
    <script src="{{ URL::asset('assets/plugins/raphael/raphael.min.js') }}"></script>
    <!--Internal  Flot js-->
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js') }}"></script>
    <script src="{{ URL::asset('assets/js/dashboard.sampledata.js') }}"></script>
    <script src="{{ URL::asset('assets/js/chart.flot.sampledata.js') }}"></script>
    <!--Internal Apexchart js-->
    <script src="{{ URL::asset('assets/js/apexcharts.js') }}"></script>
    <!-- Internal Map -->
    <script src="{{ URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <script src="{{ URL::asset('assets/js/modal-popup.js') }}"></script>
    <!--Internal  index js -->
    <script src="{{ URL::asset('assets/js/index.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.vmap.sampledata.js') }}"></script>
    <script>
        $('.hand').click(function() {
            $(this).toggleClass('waving');
        });
    </script>
@endsection
