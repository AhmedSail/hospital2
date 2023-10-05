@extends('Dashboard.layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <style>
        #btn_delete_all {
            opacity: 0;
            /* ابدأ بتعيين الشفافية على 0 */
            transform: translateY(20px);
            /* ابدأ بتحريك الزر للأسفل خارج الشاشة */
            transition: opacity 0.3s, transform 0.3s;
            /* ضبط مدة التأثير والخصائص المراد تطبيقها */
        }
    </style>
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Pages</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    Empty</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-info btn-icon ml-2"><i class="mdi mdi-filter-variant"></i></button>
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-danger btn-icon ml-2"><i class="mdi mdi-star"></i></button>
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-warning  btn-icon ml-2"><i class="mdi mdi-refresh"></i></button>
            </div>
            <div class="mb-3 mb-xl-0">
                <div class="btn-group dropdown">
                    <button type="button" class="btn btn-primary">14 Aug 2019</button>
                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                        id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuDate"
                        data-x-placement="bottom-end">
                        <a class="dropdown-item" href="#">2015</a>
                        <a class="dropdown-item" href="#">2016</a>
                        <a class="dropdown-item" href="#">2017</a>
                        <a class="dropdown-item" href="#">2018</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
@include('Dashboard.messages_alert')
    <!-- row -->
    <div class="row row-sm">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <!-- Button trigger modal -->
                    <a type="button" class="btn btn-primary" href="{{ route('doctors.create') }}"
                        style="font-weight:bold ; border-radius: 20px">
                        {{ __('doctor.Add New Doctor') }}
                    </a>
                    <button type="button" class="btn btn-danger btn-d" data-toggle="modal"
                        style="font-weight:bold ; border-radius: 20px" data-target="#delete_select" id="btn_delete_all">
                        <i class="fas fa-trash"></i>{{ __('doctor.Delete Doctors') }}
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table key-buttons text-md-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th><input type="checkbox" name="select_all" id="example-select-all"></th>
                                    <th class="border-bottom-0">{{ __('doctor.doctor image') }}</th>
                                    <th class="border-bottom-0">{{ __('doctor.Name') }}</th>
                                    <th class="border-bottom-0">{{ __('doctor.Email') }}</th>
                                    <th class="border-bottom-0">{{ __('doctor.Section') }}</th>
                                    <th class="border-bottom-0">{{ __('doctor.Phone') }}</th>
                                    <th class="border-bottom-0">{{ __('doctor.Appointments') }}</th>
                                    <th class="border-bottom-0">{{ __('doctor.Status') }}</th>
                                    <th class="border-bottom-0">{{ __('doctor.Added Date') }}</th>
                                    <th class="border-bottom-0">{{ __('doctor.Operation') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($doctors as $doctor)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><input type="checkbox" name="delete_select" value="{{ $doctor->id }}"
                                                class="delete_select"></td>
                                        <td>
                                            @if ($doctor->image)
                                                <img src="{{ asset('Dashboard/img/doctors/' . $doctor->image->filename) }}"
                                                    alt="" height="90px" width="70px">
                                            @else
                                                <img src="{{ asset('Dashboard/img/doctors/1085413.png') }}" alt=""
                                                    height="90px" width="70px">
                                            @endif
                                        </td>
                                        <td>{{ $doctor->name }}</td>
                                        <td>{{ $doctor->email }}</td>
                                        <td>{{ $doctor->section->name }}</td>
                                        <td>{{ $doctor->phone }}</td>
                                        <td>
                                            @foreach ($doctor->doctorappointments as $appointment)
                                                {{ $appointment->name }}
                                            @endforeach
                                        </td>




                                        <td>
                                            <div
                                                class="dot-label bg-{{ $doctor->status == 1 ? 'success' : 'danger' }} ml-1">
                                            </div>
                                            {{ $doctor->status == 1 ? __('doctor.Enabled') : __('doctor.Disabled') }}
                                        </td>
                                        <td>{{ $doctor->created_at->diffForHumans() }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button aria-expanded="false" aria-haspopup="true"
                                                    class="btn ripple btn-outline-primary btn-sm" data-toggle="dropdown"
                                                    type="button">{{ __('doctor.Operation') }}<i
                                                        class="fas fa-caret-down mr-1"></i></button>
                                                <div class="dropdown-menu tx-13">
                                                    <a class="dropdown-item"
                                                        href="{{ route('doctors.edit', $doctor->id) }}"><i
                                                            style="color: #0ba360"
                                                            class="text-success ti-user"></i>&nbsp;&nbsp;{{ __('doctor.Edit Information') }}</a>
                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                        data-target="#update_password{{ $doctor->id }}"><i
                                                            class="text-primary ti-key"></i>&nbsp;&nbsp;{{ __('doctor.Change Password') }}</a>
                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                        data-target="#update_status{{ $doctor->id }}"><i
                                                            class="text-warning ti-back-right"></i>&nbsp;&nbsp;{{ __('doctor.Change Status') }}</a>
                                                    <a class="dropdown-item" href="" data-toggle="modal"
                                                        data-target="#delete{{ $doctor->id }}"><i
                                                            class="text-danger  ti-trash"></i>&nbsp;&nbsp;{{ __('doctor.Delete Information') }}</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <!--####################### Modal Edit############################-->
                                    {{-- <div class="modal fade" id="edit{{ $section->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">
                                            {{ __('section_t.New Section') }}</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('sections.update', $section->id) }}"
                                            method="post" autocomplete="off">
                                            @csrf
                                            @method('put')
                                            <label>{{ __('section_t.اسم القسم') }}</label>
                                            <input type="hidden" name="id"
                                            value="{{ $section->id }}">
                                            <input type="text" name="name" class="form-control"
                                                value="{{ $section->name }}">

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">{{ __('section_t.close') }}</button>
                                                    <button type="submit"
                                                    class="btn btn-primary">{{ __('section_t.Save Change') }}</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div> --}}
                                    {{-- #########################Modal Delete############################# --}}
                                    <!-- Modal -->
                                    <div class="modal fade" id="delete{{ $doctor->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        {{ trans('doctor.Delete Doctor') }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('doctors.destroy', $doctor->id) }}"
                                                    method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <div class="modal-body">
                                                        <input type="hidden" value="1" name="page_id">
                                                        @if ($doctor->image)
                                                            <input type="hidden" name="filename"
                                                                value="{{ $doctor->image->filename }}">
                                                        @endif
                                                        <input type="hidden" name="id"
                                                            value="{{ $doctor->id }}">
                                                        <h5>{{ __('doctor.Do Uou Need Delete This Doctor') }}</h5>
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














                                    <!-- Modal -->
                                    <div class="modal fade" id="delete_select" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        {{ trans('doctor.Delete Doctor') }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('doctors.destroy', $doctor->id) }}"
                                                    method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <div class="modal-body">
                                                        <h5>{{ __('doctor.Do Uou Need Delete This Doctor') }}</h5>
                                                        <input type="hidden" value="2" name="page_id">
                                                        @if ($doctor->image)
                                                            <input type="hidden" name="filename"
                                                                value="{{ $doctor->image->filename }}">
                                                        @endif
                                                        <input type="hidden" id="delete_select_id"
                                                            name="delete_select_id" value=''>
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


                                    <!-- Modal update_password-->
                                    <div class="modal fade" id="update_password{{ $doctor->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        {{ trans('doctor.Change Password') }} <span
                                                            style="color: #045CD6">{{ $doctor->name }}</span></h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('update_password', $doctor->id) }}" method="post"
                                                    autocomplete="off">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>{{ trans('doctor.old_password') }}</label>
                                                            <input type="password"
                                                                class="form-control @error('old_password') is-invalid

                                                            @enderror"
                                                                id="old_password" name="old_password" autofocus>
                                                            @error('old_password')
                                                                <small class="invalid-feedback">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label
                                                                for="password">{{ trans('doctor.new_password') }}</label>
                                                            <input type="password"
                                                                class="form-control @error('password')
                                                            is-invaild
                                                            @enderror"
                                                                id="password" name="password">
                                                            @error('password')
                                                                <small class="invalid-feedback">{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label
                                                                for="password_confirmation">{{ trans('doctor.confirm_password') }}</label>
                                                            <input type="password"
                                                                class="form-control @error('password_confirmation')
                                                            is-invaild
                                                            @enderror"
                                                                name="password_confirmation" id="password_confirmation">
                                                            @error('password_confirmation')
                                                                <small class="invalid-feedback">{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                        <input type="hidden" name="id"
                                                            value="{{ $doctor->id }}">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ trans('section_t.Cancel') }}</button>
                                                        <button type="submit"
                                                            class="btn btn-primary">{{ trans('doctor.submit') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Modal -->
                                    <div class="modal fade" id="update_status{{ $doctor->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        {{ trans('doctor.Change Status') }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('update_status_doctor',$doctor->id) }}" method="post"
                                                    autocomplete="off">
                                                    @csrf
                                                    <div class="modal-body">

                                                        <div class="form-group">
                                                            <label for="status">{{ trans('doctor.Status') }}</label>
                                                            <select class="form-control" id="status" name="status"
                                                                required>
                                                                <option value="" selected disabled>
                                                                    --{{ trans('doctor.Choose') }}--</option>
                                                                <option value="1">{{ trans('doctor.Enabled') }}
                                                                </option>
                                                                <option value="0">{{ trans('doctor.Disabled') }}
                                                                </option>
                                                            </select>
                                                        </div>

                                                        <input type="hidden" name="id"
                                                            value="{{ $doctor->id }}">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ trans('section_t.Cancel') }}</button>
                                                        <button type="submit"
                                                            class="btn btn-primary">{{ trans('doctor.submit') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </form>
                    </div>

                </div>
            </div>
        </div>
        </tbody>
        </table>
    </div>
    </div>
    </div>
    </div>
    @include('Dashboard.Sections.add')
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}


    <!--Internal  Datatable js -->
    {{-- <script src="{{ URL::asset('assets/js/table-data.js') }}"></script> --}}
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
    <script>
        $(function() {
            jQuery("[name=select_all]").click(function(e) {
                checkboxs = jQuery("[name=delete_select]");
                for (var i in checkboxs) {
                    checkboxs[i].checked = e.target.checked;
                }
            });
        })
    </script>
    <script>
        $(document).ready(function() {
            // عند تغيير حالة الصندوق النصفي (Select All)
            $('[type=checkbox]').change(function() {
                var isChecked = $(this).prop('checked'); // تحقق من حالة الصندوق

                if (isChecked) {
                    // إذا تم تحديد الصندوق، قم بعرض الزر ببطء باستخدام التأثير
                    $('#btn_delete_all').css('opacity', '1').css('transform', 'translateY(0)');
                } else {
                    // إذا تم إلغاء تحديد الصندوق، قم بإخفاء الزر ببطء باستخدام التأثير
                    $('#btn_delete_all').css('opacity', '0').css('transform', 'translateY(20px)');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#btn_delete_all').click(function() {
                var selected = [];
                $('#example input[name=delete_select]:checked').each(function() {
                    selected.push(this.value);
                });
                if (selected.length > 0) {
                    $('#delete_select').modal('show');
                    $('input[id=delete_select_id]').val(selected);
                }
            })
        })
    </script>
@endsection
