@extends('Dashboard.layouts.master-doctor')
@section('css')
    <link href="{{ URL::asset('dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
    @include('Dashboard.notify_css')
@endsection
@section('title')
    {{ __('doctor/invoices.Patient Information') }}
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('doctor/invoices.Patient Information') }}</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ $patient->name }}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @include('Dashboard.messages_alert')
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="card" id="basic-alert">
                <div class="card-body">
                    <div class="text-wrap">
                        <div class="example">
                            <div class="panel panel-primary tabs-style-1">
                                <div class=" tab-menu-heading">
                                    <div class="tabs-menu1">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs main-nav-line">
                                            <li class="nav-item"><a href="#tab1" class="nav-link active"
                                                    data-toggle="tab">{{ __('doctor/invoices.Patient Record') }}</a></li>
                                            <li class="nav-item"><a href="#tab2" class="nav-link"
                                                    data-toggle="tab">{{ __('Patient.Rays') }}</a></li>
                                            <li class="nav-item"><a href="#tab3" class="nav-link"
                                                    data-toggle="tab">{{ __('Patient.Lab') }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body main-content-body-right border-top-0 border">
                                    <div class="tab-content">


                                        {{-- Strat Show Information Patient --}}

                                        <div class="tab-pane active" id="tab1">
                                            <br>
                                            <div class="card-body">
                                                <div class="vtimeline">
                                                    @foreach ($patient_records as $patient_record)
                                                        <div
                                                            class="timeline-wrapper {{ $loop->first ? '' : 'timeline-inverted' }} timeline-wrapper-primary">
                                                            <div class="timeline-badge"><i class="las la-check-circle"></i>
                                                            </div>
                                                            <div class="timeline-panel">
                                                                <div class="timeline-body">
                                                                    <p>{{ $patient_record->diagnosis }}</p>
                                                                </div>
                                                                <div
                                                                    class="timeline-footer d-flex align-items-center flex-wrap">
                                                                    <i class="fas fa-user-md"></i>&nbsp;
                                                                    <span>{{ $patient_record->Doctor->name }}</span>
                                                                    <span class="mr-auto"><i
                                                                            class="fe fe-calendar text-muted mr-1"></i>{{ $patient_record->date }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>

                                            </div>
                                        </div>

                                        {{-- End Show Information Patient --}}



                                        {{-- Start Invices Patient --}}

                                        <div class="tab-pane" id="tab2">

                                            <div class="table-responsive">
                                                <table class="table table-hover text-md-nowrap text-center">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>{{ __('service.Description') }}</th>
                                                            <th>{{ __('doctor.Doctor Name') }}</th>
                                                            <th>{{ __('RayEmployee.Ray Employee Name') }}</th>
                                                            <th>{{ __('RayEmployee.Diagnosis status') }}</th>
                                                            <th>{{ __('section_t.العمليات') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($patient_rays as $patient_ray)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $patient_ray->description }}</td>
                                                                <td>{{ $patient_ray->doctor->name }}</td>
                                                                <td>{{ $patient_ray->Ray_Employee->name ?? __('RayEmployee.Un Defined') }}
                                                                </td>
                                                                <td>
                                                                    @if ($patient_ray->case == 1)
                                                                        <div class="text-success">
                                                                            {{ __('RayEmployee.Completed') }}</div>
                                                                    @else
                                                                        <div class="text-danger">
                                                                            {{ __('RayEmployee.Non Completed') }}</div>
                                                                    @endif
                                                                </td>
                                                                @if ($patient_ray->doctor_id == auth()->user()->id && $patient_ray->case == 0)
                                                                    <td>
                                                                        <a class="modal-effect btn btn-sm btn-primary"
                                                                            data-effect="effect-scale" data-toggle="modal"
                                                                            href="#edit_xray_conversion{{ $patient_ray->id }}"><i
                                                                                class="fas fa-edit"></i></a>
                                                                        <a class="modal-effect btn btn-sm btn-danger"
                                                                            data-effect="effect-scale" data-toggle="modal"
                                                                            href="#delete{{ $patient_ray->id }}"><i
                                                                                class="las la-trash"></i></a>
                                                                    </td>
                                                                @else
                                                                    <td><a class="modal-effect btn btn-sm btn-primary"
                                                                            href="{{ route('doctor_invoices.show', $patient_ray->id) }}"><i
                                                                                class="las la-image"></i>
                                                                            {{ __('doctor/invoices.View') }}
                                                                        </a></td>
                                                                @endif
                                                            </tr>
                                                            {{-- @include('Dashboard.doctor.invoices.edit_xray_conversion') --}}
                                                            <div class="modal fade" id="delete{{ $patient_ray->id }}"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">
                                                                                {{ trans('doctor/invoices.Delete X-Ray') }}
                                                                            </h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <form
                                                                            action="{{ route('Rays.destroy', $patient_ray->id) }}"
                                                                            method="post">
                                                                            @method('delete')
                                                                            @csrf
                                                                            <div class="modal-body">
                                                                                <input type="hidden" name="id"
                                                                                    value="{{ $patient_ray->id }}">
                                                                                <h5>{{ __('doctor/invoices.Do You Need Delete X-Ray') }}
                                                                                </h5>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-dismiss="modal">{{ __('section_t.Cancel') }}</button>
                                                                                <button type="submit"
                                                                                    class="btn btn-danger">{{ __('section_t.Yes Delete It') }}</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="modal fade"
                                                                id="edit_xray_conversion{{ $patient_ray->id }}"
                                                                data-bs-backdrop="static" data-bs-keyboard="false"
                                                                tabindex="-1" aria-labelledby="staticBackdropLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h1 class="modal-title fs-5"
                                                                                id="staticBackdropLabel">
                                                                                {{ __('doctor/invoices.Edit X-Ray') }}</h1>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <form
                                                                            action="{{ route('Rays.update', $patient_ray->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('put')
                                                                            <div class="modal-body">
                                                                                <label
                                                                                    for="">{{ __('doctor/invoices.Required') }}</label>
                                                                                <textarea class="form-control" name="description" rows="6">{{ $patient_ray->description }}</textarea>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-dismiss="modal">{{ __('section_t.close') }}</button>
                                                                                <button type="submit"
                                                                                    class="btn btn-primary">{{ __('doctor.submit') }}</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        {{-- End Invices Patient --}}



                                        {{-- Start Receipt Patient  --}}

                                        <div class="tab-pane" id="tab3">
                                            <div class="table-responsive">
                                                <table class="table table-hover text-md-nowrap text-center">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>{{ __('service.Description') }}</th>
                                                            <th>{{ __('doctor.Doctor Name') }}</th>
                                                            <th>{{ __('section_t.العمليات') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($patient_laboratorys as $patient_laboratory)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $patient_laboratory->description }}</td>
                                                                <td>{{ $patient_laboratory->doctor->name }}</td>
                                                                @if($patient_laboratory->doctor_id == auth()->user()->id)
                                                                @if($patient_laboratory->case == 0)
                                                                    <td>
                                                                        <a class="modal-effect btn btn-sm btn-primary" data-effect="effect-scale"  data-toggle="modal" href="#edit_xray_conversion{{$patient_laboratory->id}}"><i class="fas fa-edit"></i></a>
                                                                        <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"  data-toggle="modal" href="#delete{{$patient_laboratory->id}}"><i class="las la-trash"></i></a>
                                                                    </td>
                                                                @else
                                                                    <td>
                                                                        <a class="modal-effect btn btn-sm btn-warning"  href="{{route('show.laboratorie',$patient_laboratory->id)}}"><i class="fas fa-binoculars"></i></a>
                                                                    </td>

                                                                @endif
                                                            @endif
                                                            </tr>
                                                            <div class="modal fade"
                                                                id="delete{{ $patient_laboratory->id }}" tabindex="-1"
                                                                role="dialog" aria-labelledby="exampleModalLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="exampleModalLabel">
                                                                                {{ trans('doctor/invoices.Delete Laboratory') }}
                                                                            </h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <form
                                                                            action="{{ route('Laboratory.destroy', $patient_laboratory->id) }}"
                                                                            method="post">
                                                                            @method('delete')
                                                                            @csrf
                                                                            <div class="modal-body">
                                                                                <input type="hidden" name="id"
                                                                                    value="{{ $patient_laboratory->id }}">
                                                                                <h5>{{ __('doctor/invoices.Do You Need Delete Laboratory') }}
                                                                                </h5>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-dismiss="modal">{{ __('section_t.Cancel') }}</button>
                                                                                <button type="submit"
                                                                                    class="btn btn-danger">{{ __('section_t.Yes Delete It') }}</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="modal fade"
                                                                id="edit_xray_conversion{{ $patient_laboratory->id }}"
                                                                data-bs-backdrop="static" data-bs-keyboard="false"
                                                                tabindex="-1" aria-labelledby="staticBackdropLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h1 class="modal-title fs-5"
                                                                                id="staticBackdropLabel">
                                                                                {{ __('doctor/invoices.Edit Laboratory') }}
                                                                            </h1>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <form
                                                                            action="{{ route('Laboratory.update', $patient_laboratory->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('put')
                                                                            <div class="modal-body">
                                                                                <label
                                                                                    for="">{{ __('doctor/invoices.Required') }}</label>
                                                                                <textarea class="form-control" name="description" rows="6">{{ $patient_laboratory->description }}</textarea>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-dismiss="modal">{{ __('section_t.close') }}</button>
                                                                                <button type="submit"
                                                                                    class="btn btn-primary">{{ __('doctor.submit') }}</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        {{-- End Receipt Patient  --}}


                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Prism Precode -->
                    </div>
                </div>
            </div>
        </div>


    </div>
    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
@endsection
@section('js')
    @include('Dashboard.notify_script')
@endsection
