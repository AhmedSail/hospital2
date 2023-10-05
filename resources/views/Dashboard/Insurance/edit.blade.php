@extends('Dashboard.layouts.master')
@section('css')
    <!--Internal   Notify -->
    <link href="{{ URL::asset('dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('title')
    {{ trans('insurance.Add_Insurance') }}
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">جميع الخدمات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    {{ trans('side_bar.Insurance Companies') }}</span>
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
                    <form action="{{ route('Insurances.update', $insurance->id) }}" method="post" autocomplete="off">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col">
                                <label>{{ trans('insurance.Company_code') }}</label>
                                <input type="text" name="insurance_code" value="{{ $insurance->insurance_code }}"
                                    class="form-control @error('insurance_code') is-invalid @enderror">
                                @error('insurance_code')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col">
                                <label>{{ trans('insurance.Company_name') }}</label>
                                <input type="text" name="name" value="{{ $insurance->name }}"
                                    class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>

                        <br>

                        <div class="row">
                            <div class="col">
                                <label>{{ trans('insurance.discount_percentage') }} %</label>
                                <input type="number" name="discount_percentage"
                                    class="form-control @error('discount_percentage') is-invalid @enderror"
                                    value="{{ $insurance->discount_percentage }}">
                                @error('discount_percentage')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col">
                                <label>{{ trans('insurance.Insurance_bearing_percentage') }} %</label>
                                <input type="number" name="Company_rate"
                                    class="form-control @error('Company_rate') is-invalid @enderror"
                                    value="{{ $insurance->company_rate }}">
                                @error('Company_rate')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>

                        <br>
                        <div class="col">
                            <label>{{ __('Insurance.status') }}</label>
                            @if ($insurance->status == 1)
                                <select class="form-control" id="status" name="status" required>
                                    <option value="" selected disabled>
                                        --{{ trans('doctor.Choose') }}--</option>
                                    <option selected value="1">{{ trans('doctor.Enabled') }}
                                    </option>
                                    <option value="0">{{ trans('doctor.Disabled') }}
                                    </option>
                                </select>
                            @else
                            <select class="form-control" id="status" name="status" required>
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
                                <label>{{ trans('insurance.notes') }}</label>
                                <textarea rows="5" cols="10" class="form-control" name="notes">{{ $insurance->notes }}</textarea>
                            </div>
                        </div>

                        <br>


                        <div class="row">
                            <div class="col">
                                <button class="btn btn-success">{{ trans('section_t.Save Change') }}</button>
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
