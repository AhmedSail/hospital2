@extends('Dashboard.layouts.master')

@section('css')
    @include('Dashboard.notify_css')
@endsection
@section('title')
    {{ __('side_bar.Laboratory') }}
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('side_bar.Laboratory') }}</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('RayEmployee.Add New Employee') }}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    <form action="{{ route('Laboratorys.store') }}" method="post" autocomplete="off">
        @csrf
        <div class="modal-body">
            <label for="exampleInputPassword1">{{ __('doctor.Name') }}</label>
            <input type="text" name="name"class="form-control @error('name')is-invalid @enderror">
            @error('name')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
            <br>

            <label for="exampleInputPassword1">{{ __('doctor.Email') }}</label>
            <input type="email" name="email"class="form-control @error('email')is-invalid @enderror">
            @error('email')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
            <br>

            <label for="exampleInputPassword1">{{ __('doctor.Password') }}</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
            @error('password')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
            <br>
            <button type="submit" class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5">{{ trans('doctor.submit') }}</button>
        </div>

    </form>

@endsection
@section('js')
    @include('Dashboard.notify_script')
@endsection
