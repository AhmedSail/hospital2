@extends('Dashboard.layouts.master')
@section('title')
{{ __('doctor/invoices.Add Diagnostic') }}
@stop
@section('css')

@include('Dashboard.notify_css')
    <link href="{{URL::asset('dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('doctor/invoices.Add Diagnostic') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ $ray->Patient->name }}</span>
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
                    <form action="{{ route('invoice.update',$ray->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div>
                            <label for="">{{ __('doctor/invoices.Diagnostic') }}</label>
                            <textarea name="diagnostic"  rows="6" class="form-control @error('diagnostic')
                            is-invalid
                            @enderror"></textarea>
                            @error('diagnostic')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <div>
                            <label for="" class="mt-3">{{ __('RayEmployee.Enter Diagnostic Image') }}</label>
                            <input type="file" name="photos[]" accept="image/*" multiple class="form-control @error('photo')
                            is-invalid
                            @enderror">
                            @error('photo')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success mt-3">{{ __('doctor.submit') }}</button>
                    </form>
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
