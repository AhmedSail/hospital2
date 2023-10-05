    @extends('Dashboard.layouts.master')
    @section('title')
        {{ trans('service.Single Services') }}
    @stop
    @section('css')
        <!-- Internal Data table css -->
        <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
        <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
        <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    @endsection
    @section('page-header')
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">{{ __('side_bar.Service') }}</h4><span
                        class="text-muted mt-1 tx-13 mr-2 mb-0">/
                        {{ __('service.Single Services') }}</span>
                </div>
            </div>
        </div>
    @endsection
    @section('content')
        <!-- row -->
        <!-- row opened -->
        <div class="row row-sm">
            <div class="col-xl-12">
                <div class="card mg-b-20">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('Service.create') }}" type="button" class="btn btn-primary">
                                {{ trans('service.Add New Service') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table key-buttons text-md-nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="border-bottom-0">{{ __('service.Name') }}</th>
                                        <th class="border-bottom-0">{{ __('service.Price') }}</th>
                                        <th class="border-bottom-0">{{ __('service.Status') }}</th>
                                        <th class="border-bottom-0">{{ __('service.Description') }}</th>
                                        <th class="border-bottom-0">{{ __('service.created_at') }}</th>
                                        <th class="border-bottom-0">{{ __('service.Operation') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($services as $service)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $service->name }}</td>
                                            <td>{{ $service->price }}</td>
                                            <td>
                                                <div
                                                    class="dot-label bg-{{ $service->status == 1 ? 'success' : 'danger' }} ml-1">
                                                </div>
                                                {{ $service->status == 1 ? __('doctor.Enabled') : __('doctor.Disabled') }}
                                            </td>
                                            <td> {{ Str::words($service->description, 10, '...') }}</td>
                                            <td>{{ $service->created_at->diffForHumans() }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button aria-expanded="false" aria-haspopup="true"
                                                        class="btn ripple btn-outline-primary btn-sm" data-toggle="dropdown"
                                                        type="button">{{ __('service.Operation') }}<i
                                                            class="fas fa-caret-down mr-1"></i></button>
                                                    <div class="dropdown-menu tx-13">
                                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                                            data-target="#edit{{ $service->id }}"><i
                                                                class="text-success ti-user"></i>&nbsp;&nbsp;{{ __('doctor.Edit Information') }}</a>
                                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                                            data-target="#update_status{{ $service->id }}"><i
                                                                class="text-warning ti-back-right"></i>&nbsp;&nbsp;{{ __('doctor.Change Status') }}</a>
                                                        <a class="dropdown-item" href="" data-toggle="modal"
                                                            data-target="#delete{{ $service->id }}"><i
                                                                class="text-danger  ti-trash"></i>&nbsp;&nbsp;{{ __('doctor.Delete Information') }}</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>



                                        <div class="modal fade" id="edit{{ $service->id }}" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            {{ trans('service.Update Service') }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('Service.update', $service->id) }}" method="post">
                                                        @method('put')
                                                        @csrf
                                                        <div class="modal-body">
                                                            <label for="name">{{ trans('service.Name') }}</label>
                                                            <input type="text" name="name" id="name"
                                                                class="form-control" value="{{ $service->name }}"><br>

                                                            <label for="price">{{ trans('service.Price') }}</label>
                                                            <input type="number" name="price" id="price"
                                                                class="form-control" value="{{ $service->price }}"><br>

                                                            <label for="description">{{ trans('service.Description') }}</label>
                                                            <textarea class="form-control" name="description" id="description" rows="5">{{ $service->description }}</textarea>


                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ __('section_t.Cancel') }}</button>
                                                            <button type="submit"
                                                                class="btn btn-danger">{{ __('section_t.Save Change') }}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>





                                        <div class="modal fade" id="delete{{ $service->id }}" tabindex="-1"
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
                                                    <form action="{{ route('Service.destroy', $service->id) }}"
                                                        method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <div class="modal-body">
                                                            <input type="hidden" name="id"
                                                                value="{{ $service->id }}">
                                                            <h5>{{ __('service.Do Uou Need Delete This Service') }}</h5>
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
                                        <div class="modal fade" id="update_status{{ $service->id }}" tabindex="-1"
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
                                                    <form action="{{ route('update_status_service', $service->id) }}" method="post"
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
                                                                value="{{ $service->id }}">
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--/div-->

            <!-- /row -->
            {{-- @include('Dashboard.Service.Single Service.add') --}}
        </div>
        <!-- row closed -->

        <!-- Container closed -->

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

    @endsection
