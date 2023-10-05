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
                                <th>{{ __('invoices.invoice date') }}</th>
                                <th>{{ __('doctor.Doctor Name') }}</th>
                                <th>{{ __('service.Service Name') }}</th>
                                <th>{{ __('main.Total') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($invoices as $invoice)
                                <tr>
                                    <td>{{ $loop->iteration}}</td>
                                    <td>{{ $invoice->invoice_date }}</td>
                                    <td>{{ $invoice->Doctor->name }}</td>
                                    <td>{{ $invoice->Service->name }}</td>
                                    <td>{{ $invoice->total_with_tax }}</td>
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
