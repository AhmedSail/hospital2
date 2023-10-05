@extends('Dashboard.layouts.master')
@section('title')
    {{ __('RayEmployee.Add New Employee') }}
@stop
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('Dashboard/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="{{ URL::asset('dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
    @include('Dashboard.notify_css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('side_bar.X-Ray') }}</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('RayEmployee.Add New Employee') }}</span>
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
                        <form action="{{ route('RayEmployee.store') }}" method="POST">
                            @csrf
                            <div>
                                <label for="">{{ __('doctor.Name') }}</label>
                                <input type="text" placeholder="{{ __('doctor.Name') }}" name="name"
                                    class="form-control @error('name')
                                                is-invalid
                                            @enderror">
                                @error('name')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                            <div>
                                <label for="">{{ __('doctor.Email') }}</label>
                                <input type="email" placeholder="{{ __('doctor.Email') }}" name="email"
                                    class="form-control @error('email')
                                                is-invalid
                                            @enderror">
                                @error('email')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                            <div>
                                <label for="">{{ __('doctor.Password') }}</label>
                                <input type="password" placeholder="{{ __('doctor.Password') }}" name="password"
                                    class="form-control @error('password')
                                                is-invalid
                                            @enderror">
                                @error('password')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                            <div>
                                <button class="btn btn-success mt-3" type="submit">{{ __('doctor.submit') }}</button>
                            </div>
                        </form>
                    </div>
                </div><!-- bd -->
            </div><!-- bd -->
        </div>
        <!--/div-->

        {{-- @include('Dashboard.ray_employee.add') --}}
        <!-- /row -->

    </div>
    <!-- row closed -->

    <!-- Container closed -->

    <!-- main-content closed -->
@endsection

@section('js')
    @include('Dashboard.notify_script')
@endsection
