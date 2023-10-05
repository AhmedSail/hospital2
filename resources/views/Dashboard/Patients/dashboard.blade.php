@extends('Dashboard.layouts.master')
@section('css')
    <!--  Owl-carousel css-->
    <link href="{{ URL::asset('Dashboard/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet" />
    <!-- Maps css -->
    <link href="{{ URL::asset('Dashboard/plugins/jqvmap/jqvmap.min.css') }}" rel="stylesheet">
    <style>
        #tab1{
            cursor: pointer;
        }
        #tab2{
            cursor: pointer;
        }
    </style>
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div>
            <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1 d-flex">
                {{ __('main.Welcome Back') }}{{ Auth::user()->name }} <div class="hand">👋</div>
            </h2>
            <p class="mg-b-0 mt-2">{{ __('main.Admin Portal') }}</p>
        </div>
    </div>
    <!-- /breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm" >
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12" id="tab1">
            <div class="card overflow-hidden sales-card bg-primary-gradient">
                <div class="px-3 pt-3  pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">{{ __('main.Total Of Invoices Number') }}</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 fw-bold mb-1 text-white">
                                    {{ App\Models\Invoice::where('patient_id', auth()->user()->id)->count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div> <span id="compositeline" class="pt-1"><canvas width="392" height="30"
                        style="display: inline-block; width: 392.5px; height: 30px; vertical-align: top;"></canvas></span>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12" id="tab2">
            <div class="card overflow-hidden sales-card bg-danger-gradient">
                <div class="px-3 pt-3  pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">{{ __('Patient.debit') }}</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                @if (App\Models\PatientAccount::where('patient_id', auth()->user()->id)->sum('debit') == 0)
                                    <h4 class="tx-20 fw-bold mb-1 text-white">
                                        {{ App\Models\PatientAccount::where('patient_id', auth()->user()->id)->sum('debit') }}
                                    </h4>
                                @else<h4 class="tx-20 fw-bold mb-1 text-white">
                                        ${{ App\Models\PatientAccount::where('patient_id', auth()->user()->id)->sum('debit') }}
                                    </h4>
                                @endif
                            </div>
                        </div>
                    </div>
                </div> <span id="compositeline2" class="pt-1"><canvas width="392" height="30"
                        style="display: inline-block; width: 392.5px; height: 30px; vertical-align: top;"></canvas></span>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12" id="tab2">
            <div class="card overflow-hidden sales-card bg-success-gradient">
                <div class="px-3 pt-3  pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">{{ __('Patient.credit') }}</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <div class="">
                                    @if (App\Models\PatientAccount::where('patient_id', auth()->user()->id)->sum('credit') == 0)
                                        <h4 class="tx-20 fw-bold mb-1 text-white">
                                            {{ App\Models\PatientAccount::where('patient_id', auth()->user()->id)->sum('credit') }}
                                        </h4>
                                    @else<h4 class="tx-20 fw-bold mb-1 text-white">
                                            ${{ App\Models\PatientAccount::where('patient_id', auth()->user()->id)->sum('credit') }}
                                        </h4>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <span id="compositeline3" class="pt-1"><canvas width="392" height="30"
                        style="display: inline-block; width: 392.5px; height: 30px; vertical-align: top;"></canvas></span>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12" id="tab2">
            <div class="card overflow-hidden sales-card bg-warning-gradient">
                <div class="px-3 pt-3  pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">{{ __('main.Total') }}</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <div class="">
                                    @if (number_format(App\Models\PatientAccount::where('patient_id', auth()->user()->id)->sum('debit') -
                                                App\Models\PatientAccount::where('patient_id', auth()->user()->id)->sum('credit'),
                                            2) == 0)
                                        <h4 class="tx-20 fw-bold mb-1 text-white">
                                            {{ number_format(App\Models\PatientAccount::where('patient_id', auth()->user()->id)->sum('debit') - App\Models\PatientAccount::where('patient_id', auth()->user()->id)->sum('credit'), 2) }}
                                        </h4>
                                    @else<h4 class="tx-20 fw-bold mb-1 text-white">
                                            ${{ number_format(App\Models\PatientAccount::where('patient_id', auth()->user()->id)->sum('debit') - App\Models\PatientAccount::where('patient_id', auth()->user()->id)->sum('credit'), 2) }}
                                        </h4>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <span id="compositeline4" class="pt-1"><canvas width="392" height="30"
                        style="display: inline-block; width: 392.5px; height: 30px; vertical-align: top;"></canvas></span>
            </div>
        </div>
    </div>

    <!-- row closed -->

    <div class="row row-sm row-deck">
        <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="card card-table-two">
                <div class="d-flex justify-content-between">
                    <h2 class="card-title mb-1">{{ __('RayEmployee.Last 5 Invoices In The System') }}</h2>
                </div><br>
                <div class="table-responsive country-table">
                    <table class="table table-striped table-bordered mb-0 text-sm-nowrap text-lg-nowrap text-xl-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('invoices.invoice date') }}</th>
                                <th>{{ __('Patient.Patient Name') }}</th>
                                <th>{{ __('doctor.Doctor Name') }}</th>
                                <th>{{ __('Patient.status') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(\App\Models\Invoice::latest()->take(5)->where('patient_id',auth()->user()->id)->get() as $invoice)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="tx-right tx-medium tx-inverse">{{ $invoice->created_at }}</td>
                                    <td class="tx-right tx-medium tx-danger">{{ $invoice->patient->name }}</td>
                                    <td class="tx-right tx-medium tx-inverse">{{ $invoice->doctor->name }}</td>
                                    <td class="tx-right tx-medium tx-inverse">
                                        @if ($invoice->case == 0)
                                            <span
                                                class="badge badge-danger">{{ __('doctor/invoices.Under Process') }}</span>
                                        @else
                                            <span class="badge badge-success">{{ __('RayEmployee.Completed') }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <td colspan="6" class="text-center">{{ __('main.No Available Data') }}</td>
                            @endforelse
                        </tbody>
                    </table>
                </div>
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
    <script>
        $(document).ready(function() {
            // Handle the tab click event
            $('#tab1').click(function(e) {
                e.preventDefault(); // Prevent the default link behavior

                // Navigate to the specified route
                window.location.href = "{{ route('Patient.index') }}";
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Handle the tab click event
            $('#tab2').click(function(e) {
                e.preventDefault(); // Prevent the default link behavior

                // Navigate to the specified route
                window.location.href = "{{ route('Patient.show',auth()->user()->id) }}";
            });
        });
    </script>
@endsection
