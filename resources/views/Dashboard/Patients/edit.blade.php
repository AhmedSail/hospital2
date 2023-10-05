@extends('Dashboard.layouts.master')
@section('css')
    <!--Internal   Notify -->
    <link href="{{ URL::asset('dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('title')
   {{ __('Patient.Add Patient') }}
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('Patient.Patients') }}</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('side_bar.Patients List') }}</span>
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
                    <form action="{{ route('Patients.update', $Patient->id) }}" method="post" autocomplete="off">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-3">
                                <label>{{ __('Patient.Patient Name') }}</label>
                                <input type="text" name="name" value="{{ $Patient->name }}"
                                    class="form-control @error('name') is-invalid @enderror ">
                                @error('name')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col">
                                <label>{{ __('Patient.Email') }}</label>
                                <input type="email" name="email" value="{{ $Patient->email }}"
                                    class="form-control @error('email') is-invalid @enderror">
                                @error('email')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>


                            <div class="col">
                                <label>{{ __('Patient.Birth Date') }}</label>
                                <input class="form-control fc-datepicker" name="Date_Birth" placeholder="YYYY-MM-DD"
                                    type="date" value="{{ $Patient->date_birth }}">
                                @error('Date_Birth')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>
                        <br>

                        <div class="row">
                            <div class="col-3">
                                <label>{{ __('Patient.Phone') }}</label>
                                <input type="number" name="Phone" value="{{ $Patient->phone }}"
                                    class="form-control @error('Phone') is-invalid @enderror">
                                @error('Phone')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col">
                                <label>{{ __('Patient.Gender') }}</label>
                                <select class="form-control" name="Gender">
                                    <option value="" selected>-- {{ __('Pati    ent.Choose From List') }} --</option>
                                    <option value="1" {{ $Patient->gender == 1 ? 'selected' : '' }}>
                                        {{ __('Patient.Male') }}</option>
                                    <option value="2" {{ $Patient->gender == 2 ? 'selected' : '' }}>
                                        {{ __('Patient.Female') }}</option>
                                </select>
                                @error('Gender')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col">
                                <label>{{ __('Patient.Blood Group') }}</label>
                                <select class="form-control" name="Blood_Group">
                                    <option value="" selected>-- {{ __('Patient.C   hoose From List') }}--</option>
                                    <option value="O-"{{ $Patient->blood_group == 'O-' ? 'selected' : '' }}>O-</option>
                                    <option value="O+" {{ $Patient->blood_group == 'O+' ? 'selected' : '' }}>O+</option>
                                    <option value="A+" {{ $Patient->blood_group == 'A+' ? 'selected' : '' }}>A+</option>
                                    <option value="A-" {{ $Patient->blood_group == 'A-' ? 'selected' : '' }}>A-</option>
                                    <option value="B+" {{ $Patient->blood_group == 'B+' ? 'selected' : '' }}>B+</option>
                                    <option value="B-" {{ $Patient->blood_group == 'B-' ? 'selected' : '' }}>B-</option>
                                    <option value="AB+"{{ $Patient->blood_group == 'AB+' ? 'selected' : '' }}>AB+</option>
                                    <option value="AB-"{{ $Patient->blood_group == 'AB-' ? 'selected' : '' }}>AB-</option>
                                </select>
                                @error('Blood_Group')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col">
                                <label>{{ __('Patient.Address') }}</label>
                                <textarea rows="5" class="form-control" name="Address">{{ $Patient->Address }}</textarea>
                                @error('Address')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
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
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('dashboard/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();
    </script>
    <script src="{{ URL::asset('dashboard/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('/plugins/notify/js/notifit-custom.js') }}"></script>
@endsection
