@extends('Dashboard.layouts.master')
@section('css')
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('Dashboard/plugins/sumoselect/sumoselect-rtl.css') }}">
    <link href="{{ URL::asset('dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"> {{ __('doctor.Add New Doctor') }}</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    {{ __('doctor.Add New Doctor') }}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
@include('Dashboard.messages_alert')
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('doctors.store') }}" method="post" autocomplete="off"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="pd-30 pd-sm-40 bg-gray-200">

                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        {{ __('doctor.Name') }}</label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <input name="name" type="text"
                                        class="form-control @error('name')
                                    is-invalid
                                    @enderror">
                                    @error('name')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror

                                </div>
                            </div>

                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        {{ __('doctor.Email') }}</label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <input name="email" type="email"
                                        class="form-control @error('email')
                                    is-invalid
                                    @enderror">
                                    @error('email')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        {{ __('doctor.Password') }}</label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <input name="password" type="password"
                                        class="form-control @error('password')
                                    is-invalid
                                    @enderror">
                                    @error('password')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        {{ __('doctor.Phone') }}</label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <input name="phone" type="tel"
                                        class="form-control @error('phone')
                                    is-invalid
                                    @enderror">
                                    @error('phone')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>


                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        {{ __('doctor.Section') }}</label>
                                </div>

                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <select name="section_id"
                                        class="form-control @error('section_id')is-invalid @enderror SlectBox">
                                        <option value="" selected disabled>------</option>
                                        @foreach ($sections as $section)
                                            <option value="{{ $section->id }}">{{ $section->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('section_id')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>

                            </div>

                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        {{ __('doctor.Appointments') }}</label>
                                </div>


                                {{-- <label class="col-md-1">{{ __('doctor.Appointments') }}</label> --}}
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <select class="js-example-basic-multiple form-control"  name="appointments[]"multiple="multiple">

                                        <option name="appointments[]" value=""  disabled>
                                            {{ __('doctor.-- حدد المواعيد --') }}</option>
                                        @foreach ($appointments as $appointment)
                                            <option value="{{ $appointment->id }}">{{ $appointment->name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>




                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        {{ __('doctor.doctor_photo') }}</label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <input type="file" accept="image/*" name="photo" onchange="loadFile(event)"
                                        class=" @error('photo')
                                    is-invalid
                                    @enderror">
                                    @error('photo')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                    <img style="border-radius:50%" width="150px" height="150px" id="output" />
                                </div>
                            </div>




                            <button type="submit"
                                class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5">{{ __('doctor.submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <script>
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('Dashboard/js/select2.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/js/advanced-form-elements.js') }}"></script>

    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('Dashboard/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
    </script>
@endsection
