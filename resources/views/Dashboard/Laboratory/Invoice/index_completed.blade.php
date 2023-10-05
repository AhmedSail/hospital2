@extends('Dashboard.layouts.master')
@section('title')
{{ __('doctor/invoices.Records') }}
@stop
@section('css')

@include('Dashboard.notify_css')
    <link href="{{URL::asset('dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('doctor/invoices.Records') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('side_bar.Invoices') }}</span>
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
                                <th>{{ __('invoices.invoice date') }}</th>
                                <th>{{ __('Patient.Patient Name') }}</th>
                                <th>{{ __('doctor.Doctor Name') }}</th>
                                <th>{{ __('doctor/invoices.Required') }}</th>
                                <th>{{ __('doctor.Status') }}</th>
                                <th>{{ __('doctor.Operation') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($laboratorys as $laboratory)
                                <tr>
                                    <td>{{ $loop->iteration}}</td>
                                    <td>{{ $laboratory->created_at }}</td>
                                    <td><a href="{{ route('LaboratoryEmployee.show',$laboratory->id) }}">{{ $laboratory->Patient->name }}</a></td>
                                    <td>{{ $laboratory->doctor->name }}</td>
                                    <td>{{ $laboratory->description }}</td>
                                    <td>
                                        @if($laboratory->case == 0)
                                            <span class="badge badge-danger">{{ __('doctor/invoices.Under Process') }}</span>
                                        @else
                                            <span class="badge badge-success">{{ __('RayEmployee.Completed') }}</span>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="dropdown">
                                            <button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-outline-primary btn-sm" data-toggle="dropdown" type="button">{{trans('doctor.Operation')}}<i class="fas fa-caret-down mr-1"></i></button>
                                            <div class="dropdown-menu tx-13">
                                                <a class="dropdown-item" href="{{ route('LaboratoryEmployee.edit',$laboratory->id) }}"><i class="text-primary fa fa-stethoscope"></i>&nbsp;&nbsp;{{ __('doctor/invoices.Add Diagnostic') }}</a>
                                            </div>
                                        </div>
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
