@extends('Dashboard.layouts.master')
@section('css')
    <link href="{{ URL::asset('dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
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
    <!-- row opened -->
    <div class="row row-sm">
        <!--div-->
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('Patients.create') }}" class="btn btn-primary">{{ __('Patient.Add Patient') }}</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('Patient.Patient Name') }}</th>
                                    <th>{{ __('Patient.Email') }}</th>
                                    <th>{{ __('Patient.Birth Date') }}</th>
                                    <th>{{ __('Patient.Phone') }}</th>
                                    <th>{{ __('Patient.Gender') }}</th>
                                    <th>{{ __('Patient.Blood Group') }}</th>
                                    <th>{{ __('Patient.Address') }}</th>
                                    <th>{{ __('Patient.Operations') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Patients as $Patient)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><a href="{{ route('Patients.show',$Patient->id) }}" >{{ $Patient->name }}</a></td>
                                        <td>{{ $Patient->email }}</td>
                                        <td>{{ $Patient->date_birth }}</td>
                                        <td>{{ $Patient->phone }}</td>
                                        <td>{{ $Patient->gender ==1 ? __('Patient.Male') : __('Patient.Female')}}</td>
                                        <td>{{ $Patient->blood_group }}</td>
                                        <td>{{ $Patient->Address }}</td>
                                        <td>
                                            <a href="{{ route('Patients.edit', $Patient->id) }}"
                                                class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                                <button class="btn btn-sm btn-danger" data-toggle="modal"
                                                data-target="#Deleted{{ $Patient->id }}"><i
                                                class="fas fa-trash"></i></button>
                                                <a href="{{ route('Patients.show', $Patient->id) }}"
                                                    class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="Deleted{{ $Patient->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        {{ trans('Patient.Delete Patient') }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('Patients.destroy', $Patient->id) }}"
                                                    method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <div class="modal-body">
                                                        <input type="hidden" name="id" value="{{ $Patient->id }}">
                                                        <h5>{{ __('Patient.Do Uou Need Delete This Patient') }}</h5>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ __('section_t.Cancel') }}</button>
                                                        <button type="submit"
                                                            class="btn btn-danger">{{ __('section_t.Yes Delete It') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!-- bd -->
            </div><!-- bd -->
        </div>
        <!--/div-->
    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Notify js -->
    <script src="{{ URL::asset('dashboard/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('/plugins/notify/js/notifit-custom.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    @if (session('msg'))
        <script>
            Swal.fire(
                '{{ session('good') }}',
                '{{ session('msg') }}',
                'success'
            )
        </script>
    @endif
@endsection
