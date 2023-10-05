@extends('Dashboard.layouts.master')
@section('title')
{{ __('Patient.Invoices List') }}
@stop
@section('css')

@include('Dashboard.notify_css')
    <link href="{{URL::asset('dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('Patient.Invoices List') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ auth()->user()->name }}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @include('Dashboard.messages_alert')
    <!-- row -->
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('doctor/invoices.Required') }}</th>
                                <th>{{ __('doctor.Doctor Name') }}</th>
                                <th>{{ __('RayEmployee.Laboratory Employee Name') }}</th>
                                <th>{{ __('doctor.Operation') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($laboratories as $laboratory)
                                <tr>
                                    <td>{{ $loop->iteration}}</td>
                                    <td>{{ $laboratory->description }}</td>
                                    <td>{{ $laboratory->doctor->name }}</td>
                                    <td>{{ $laboratory->Laboratory_Employee->name }}</td>
                                    <td>
                                        <a href="{{ route('show_test',$laboratory->id) }}" class="btn btn-primary btn-sm">{{ __('doctor/invoices.View') }}</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!-- bd -->
            </div><!-- bd -->
        </div>
        <!--/div-->

        <!-- /row -->
    </div>
    <!-- row closed -->

    <!-- Container closed -->

    <!-- main-content closed -->
@endsection
@section('js')

    @include('Dashboard.notify_script')

@endsection
