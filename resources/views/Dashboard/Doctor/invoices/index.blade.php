@extends('Dashboard.layouts.master-doctor')
@section('title')
    {{ __('doctor/invoices.Records') }}
@stop
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('Dashboard/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="{{ URL::asset('dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />

    <link href="{{ URL::asset('dashboard/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!--Internal  Datetimepicker-slider css -->
    <link href="{{ URL::asset('dashboard/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('dashboard/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css') }}"
        rel="stylesheet">
    <link href="{{ URL::asset('dashboard/plugins/pickerjs/picker.min.css') }}" rel="stylesheet">
    <!-- Internal Spectrum-colorpicker css -->
    <link href="{{ URL::asset('dashboard/plugins/spectrum-colorpicker/spectrum.css') }}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
<!--Internal   Notify -->
<link href="{{URL::asset('assets/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
<!--Internal  treeview -->
<link href="{{URL::asset('assets/plugins/treeview/treeview.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('doctor/invoices.Records') }}</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('side_bar.Invoices') }}</span>
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
                                    <th>{{ __('invoices.Service Name') }}</th>
                                    <th>{{ __('Patient.Patient Name') }}</th>
                                    <th>{{ __('invoices.Service Price') }}</th>
                                    <th>{{ __('invoices.Discount Value') }}</th>
                                    <th>{{ __('invoices.Tax Rate') }}</th>
                                    <th>{{ __('invoices.Tax Value') }}</th>
                                    <th>{{ __('invoices.Total with Tax') }}</th>

                                    <th>{{ __('doctor.Status') }}</th>
                                    <th>{{ __('section_t.العمليات') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $invoice)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $invoice->invoice_date }}</td>
                                        <td>{{ $invoice->Service->name ?? $invoice->Group->name }}</td>
                                        <td><a
                                                href="{{ route('Patient_Detail', $invoice->patient_id) }}">{{ $invoice->Patient->name }}</a>
                                        </td>
                                        <td>{{ number_format($invoice->price, 2) }}</td>
                                        <td>{{ number_format($invoice->discount_value, 2) }}</td>
                                        <td>{{ $invoice->tax_rate }}%</td>
                                        <td>{{ number_format($invoice->tax_value, 2) }}</td>
                                        <td>{{ number_format($invoice->total_with_tax, 2) }}</td>

                                        <td>
                                            @if ($invoice->invoice_status == 1)
                                                <span
                                                    class="badge badge-danger">{{ __('doctor/invoices.Under Process') }}</span>
                                            @elseif($invoice->invoice_status == 2)
                                                <span class="badge badge-warning">{{ __('doctor/invoices.Review') }}</span>
                                            @else
                                                <span
                                                    class="badge badge-success">{{ __('doctor/invoices.Completed') }}</span>
                                            @endif
                                        </td>

                                        <td>

                                            <div class="dropdown">
                                                <button aria-expanded="false" aria-haspopup="true"
                                                    class="btn ripple btn-outline-primary btn-sm" data-toggle="dropdown"
                                                    type="button">{{ trans('service.Operation') }}<i
                                                        class="fas fa-caret-down mr-1"></i></button>
                                                <div class="dropdown-menu tx-13">
                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                        data-target="#add_diagnosis{{ $invoice->id }}"><i
                                                            class="text-primary fa fa-stethoscope"></i>&nbsp;&nbsp;{{ __('doctor/invoices.Add Diagnostic') }}
                                                    </a>
                                                    <a class="dropdown-item" data-toggle="modal" href="#"
                                                        data-target="#add_review{{ $invoice->id }}"><i
                                                            class="text-warning far fa-file-alt"></i>&nbsp;&nbsp;
                                                        {{ __('doctor/invoices.Add Review') }}
                                                    </a>
                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                        data-target="#transfer_x_ray{{ $invoice->id }}"><i
                                                            class="text-primary fas fa-x-ray"></i>&nbsp;&nbsp;
                                                        {{ __('doctor/invoices.Transfer To X-ray') }}
                                                    </a>
                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                        data-target="#laboratorie_conversion{{ $invoice->id }}"><i
                                                            class="text-warning fas fa-syringe"></i>&nbsp;&nbsp;
                                                        {{ __('doctor/invoices.Transfer To Laboratory') }}
                                                    </a>
                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                        data-target="#delete{{ $invoice->id }}"><i
                                                            class="text-danger  ti-trash"></i>&nbsp;&nbsp;{{ __('doctor/invoices.Delete Information') }}
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>



                                    <!-- Modal -->

                                    <div class="modal fade" id="add_diagnosis{{ $invoice->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        {{ __('doctor/invoices.Diagnosis of the Patient') }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('Diagnosis.store') }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">

                                                        <input type="hidden" name="invoice_id"
                                                            value="{{ $invoice->id }}">
                                                        <input type="hidden" name="patient_id"
                                                            value="{{ $invoice->patient_id }}">
                                                        <input type="hidden" name="doctor_id"
                                                            value="{{ $invoice->doctor_id }}">

                                                        <div class="form-group">
                                                            <label
                                                                for="exampleFormControlTextarea1">{{ __('doctor/invoices.Diagnostic') }}</label>
                                                            <textarea class="form-control" name="diagnosis" rows="6"></textarea>
                                                        </div>

                                                        <div class="form-group">
                                                            <label
                                                                for="exampleFormControlTextarea1">{{ __('doctor/invoices.Medicines') }}</label>
                                                            <textarea class="form-control" name="medicine" rows="6"></textarea>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ __('section_t.close') }}</button>
                                                            <button type="submit"
                                                                class="btn btn-primary">{{ __('doctor.submit') }}</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>



                                    <!-- Modal -->
                                    <div class="modal fade" id="add_review{{ $invoice->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        {{ __('doctor/invoices.Define Review Of Patient') }}
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('add_review') }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">

                                                        <input type="hidden" name="invoice_id"
                                                            value="{{ $invoice->id }}">
                                                        <input type="hidden" name="patient_id"
                                                            value="{{ $invoice->patient_id }}">
                                                        <input type="hidden" name="doctor_id"
                                                            value="{{ $invoice->doctor_id }}">

                                                        <div class="form-group">
                                                            <label
                                                                for="exampleFormControlTextarea1">{{ __('doctor/invoices.Diagnostic') }}</label>
                                                            <textarea class="form-control" name="diagnosis" rows="6"></textarea>
                                                        </div>

                                                        <div class="form-group">
                                                            <label
                                                                for="exampleFormControlTextarea1">{{ __('doctor/invoices.Medicines') }}</label>
                                                            <textarea class="form-control" name="medicine" rows="6"></textarea>
                                                        </div>


                                                        <div class="form-group" style="position:relative;">
                                                            <label>{{ __('doctor/invoices.Date Of Review') }}</label>
                                                            <input class="form-control fc-datepicker" id="review_date"
                                                                name="review_date" type="date_time" required>
                                                        </div>



                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ __('section_t.close') }}</button>
                                                        <button type="submit"
                                                            class="btn btn-primary">{{ __('doctor.submit') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="modal fade" id="transfer_x_ray{{ $invoice->id }}" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">
                                                        {{ __('doctor/invoices.Transfer To X-ray') }}</h1>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('Rays.store') }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <input type="hidden" name="invoice_id"
                                                            value="{{ $invoice->id }}">
                                                        <input type="hidden" name="patient_id"
                                                            value="{{ $invoice->patient_id }}">
                                                        <input type="hidden" name="doctor_id"
                                                            value="{{ $invoice->doctor_id }}">

                                                        <div class="form-group">
                                                            <label>{{ __('doctor/invoices.Required') }}</label>
                                                            <textarea class="form-control" name="description" rows="6" required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ __('section_t.close') }}</button>
                                                        <button type="submit"
                                                            class="btn btn-primary">{{ __('doctor.submit') }}</button>
                                                    </div>
                                                </form>


                                            </div>
                                        </div>
                                    </div>



                                    <div class="modal fade" id="laboratorie_conversion{{ $invoice->id }}" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">
                                                        {{ __('doctor/invoices.Transfer To Laboratory') }}</h1>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('Laboratory.store') }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <input type="hidden" name="invoice_id"
                                                            value="{{ $invoice->id }}">
                                                        <input type="hidden" name="patient_id"
                                                            value="{{ $invoice->patient_id }}">
                                                        <input type="hidden" name="doctor_id"
                                                            value="{{ $invoice->doctor_id }}">

                                                        <div class="form-group">
                                                            <label>{{ __('doctor/invoices.Required') }}</label>
                                                            <textarea class="form-control" name="description" rows="6" required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ __('section_t.close') }}</button>
                                                        <button type="submit"
                                                            class="btn btn-primary">{{ __('doctor.submit') }}</button>
                                                    </div>
                                                </form>


                                            </div>
                                        </div>
                                    </div>



                                    {{-- <div class="modal fade" id="delete{{ $invoice->id }}" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">
                                                        {{ __('doctor/invoices.Delete Information') }}</h1>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('Diagnosis.destroy',$invoice->id) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <div class="modal-body">
                                                        <input type="hidden" name="invoice_id"
                                                            value="{{ $invoice->id }}">
                                                        <input type="hidden" name="patient_id"
                                                            value="{{ $invoice->patient_id }}">
                                                        <input type="hidden" name="doctor_id"
                                                            value="{{ $invoice->doctor_id }}">

                                                        <div class="form-group">
                                                            {{ __('doctor/invoices.Do You Need Delete Information') }}
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ __('section_t.close') }}</button>
                                                        <button type="submit"
                                                            class="btn btn-primary">{{ __('doctor.submit') }}</button>
                                                    </div>
                                                </form>


                                            </div>
                                        </div>
                                    </div> --}}
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


    <!--Internal  Notify js -->
    <script src="{{URL::asset('assets/plugins/treeview/treeview.js')}}"></script>
    <!--Internal  Notify js -->
    <script src="{{URL::asset('assets/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/notify/js/notifit-custom.js')}}"></script>


    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('dashboard/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('dashboard/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('dashboard/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal Select2.min js -->
    <script src="{{ URL::asset('dashboard/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Ion.rangeSlider.min js -->
    <script src="{{ URL::asset('dashboard/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
    <!--Internal  jquery-simple-datetimepicker js -->
    <script src="{{ URL::asset('dashboard/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js') }}"></script>
    <!-- Ionicons js -->
    <script src="{{ URL::asset('dashboard/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js') }}"></script>
    <!--Internal  pickerjs js -->
    <script src="{{ URL::asset('dashboard/plugins/pickerjs/picker.min.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('dashboard/js/form-elements.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js">
    </script>
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

    <script>
        $(document).ready(function() {
            $('#review_date').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss', // يمكنك تغيير التنسيق حسب احتياجاتك
                sideBySide: true // لعرض التاريخ والوقت جنبًا إلى جنب
            });
        });
    </script>

@endsection
