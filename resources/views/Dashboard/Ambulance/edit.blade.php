@extends('Dashboard.layouts.master')
@section('css')
    <!--Internal   Notify -->
    <link href="{{ URL::asset('dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('title')
    {{ __('Ambulance.Add Ambulance') }}
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('side_bar.Ambulance') }}</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('Ambulance.Add Ambulance') }}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('Ambulances.update', $ambulance->id) }}" method="post" autocomplete="off">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col">
                                <label>{{ __('Ambulance.Car Number') }}</label>
                                <input type="text" name="car_number" value="{{ $ambulance->car_number }}"
                                    class="form-control @error('car_number') is-invalid @enderror">
                            </div>

                            <div class="col">
                                <label>{{ __('Ambulance.Car Model') }}</label>
                                <input type="text" name="car_model" value="{{ $ambulance->car_model }}"
                                    class="form-control @error('car_model') is-invalid @enderror">
                            </div>

                            <div class="col">
                                <label>{{ __('Ambulance.Car Year Made') }}</label>
                                <input type="number" name="car_year_made" value="{{ $ambulance->car_year_made }}"
                                    class="form-control @error('car_year_made') is-invalid @enderror">
                            </div>

                            <div class="col">
                                <label>{{ __('Ambulance.Car Type') }}</label>
                                <select class="form-control" name="car_type">
                                    @if ($ambulance->car_type == 1)
                                        <option selected value="1">{{ __('Ambulance.مملوكة') }}</option>
                                        <option value="0">{{ __('Ambulance.إيجار') }}</option>
                                    @elseif ($ambulance->car_type == 0)
                                        <option value="1">{{ __('Ambulance.مملوكة') }}</option>
                                        <option selected value="0">{{ __('Ambulance.إيجار') }}</option>
                                    @endif
                                </select>
                            </div>

                        </div>
                        <br>

                        <div class="row">
                            <div class="col-3">
                                <label>{{ __('Ambulance.Driver Name') }}</label>
                                <input type="text" name="driver_name" value="{{ $ambulance->driver_name }}"
                                    class="form-control @error('driver_name') is-invalid @enderror">
                            </div>

                            <div class="col-3">
                                <label>{{ __('Ambulance.Driver License Number') }}</label>
                                <input type="number" name="driver_license_number"
                                    value="{{ $ambulance->driver_license_number }}"
                                    class="form-control @error('driver_license_number') is-invalid @enderror">
                            </div>

                            <div class="col-6">
                                <label>{{ __('Ambulance.Driver Phone') }}</label>
                                <input type="number" name="driver_phone" value="{{ $ambulance->driver_phone }}"
                                    class="form-control @error('driver_phone') is-invalid @enderror">
                            </div>

                        </div>

                        <br>
                        <div class="col">
                            <label>{{ __('Ambulance.status') }}</label>
                            @if ($ambulance->is_available == 1)
                                <select class="form-control" id="status" name="is_available" required>
                                    <option value="" selected disabled>
                                        --{{ trans('doctor.Choose') }}--</option>
                                    <option selected value="1">{{ trans('doctor.Enabled') }}
                                    </option>
                                    <option value="0">{{ trans('doctor.Disabled') }}
                                    </option>
                                </select>
                            @else
                                <select class="form-control" id="status" name="is_available" required>
                                    <option value="" selected disabled>
                                        --{{ trans('doctor.Choose') }}--</option>
                                    <option value="1">{{ trans('doctor.Enabled') }}
                                    </option>
                                    <option selected value="0">{{ trans('doctor.Disabled') }}
                                    </option>
                                </select>
                            @endif
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <label>{{ __('Ambulance.notes') }}</label>
                                <textarea rows="5" cols="10" class="form-control" name="notes">{{ $ambulance->notes }}</textarea>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col">
                                <button class="btn btn-success">{{ __('section_t.Save Change') }}</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    <script src="{{ URL::asset('dashboard/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('/plugins/notify/js/notifit-custom.js') }}"></script>
@endsection
