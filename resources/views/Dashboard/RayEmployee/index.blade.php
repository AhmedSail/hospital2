@extends('Dashboard.layouts.master')
@section('title')
    {{ __('side_bar.Employee List') }}
@stop
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('Dashboard/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="{{ URL::asset('dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
    @include('Dashboard.notify_css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('side_bar.X-Ray') }}</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('side_bar.Employee List') }}</span>
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
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <a type="button" class="btn btn-primary" href="{{ route('RayEmployee.create') }}">
                            {{ __('RayEmployee.Add New Employee') }}
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table style="text-align: center" class="table text-md-nowrap" id="example1">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('doctor.Name') }}</th>
                                    <th>{{ __('doctor.Email') }}</th>
                                    <th>{{ __('doctor.Added Date') }}</th>
                                    <th>{{ __('doctor.Operation') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ray_employees as $ray_employee)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $ray_employee->name }}</td>
                                        <td>{{ $ray_employee->email }}</td>
                                        <td>{{ $ray_employee->created_at->diffForHumans() }}</td>
                                        <td>
                                            <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                data-toggle="modal" href="#edit{{ $ray_employee->id }}"><i
                                                    class="las la-pen"></i></a>
                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                data-toggle="modal" href="#delete{{ $ray_employee->id }}"><i
                                                    class="las la-trash"></i></a>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="edit{{ $ray_employee->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        {{ trans('RayEmployee.Edit Employee') }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('RayEmployee.update', $ray_employee->id) }}"
                                                    method="post">
                                                    @method('put')
                                                    @csrf
                                                    <input type="hidden" name="id"
                                                            value="{{ $ray_employee->id }}">
                                                    <div class="modal-body">
                                                        <div>
                                                            <label for="">{{ __('doctor.Name') }}</label>
                                                            <input type="text" placeholder="Name" name="name"
                                                                class="form-control" value="{{ $ray_employee->name }}" required>
                                                        </div>
                                                        <div>
                                                            <label for="">{{ __('doctor.Email') }}</label>
                                                            <input type="email" placeholder="Email" name="email"
                                                                class="form-control" required value="{{ $ray_employee->email }}">
                                                        </div>
                                                        <div>
                                                            <label for="">{{ __('doctor.Password') }}</label>
                                                            <input type="password" placeholder="{{ __('doctor.Password') }}" name="password"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ __('section_t.Cancel') }}</button>
                                                        <button type="submit"
                                                            class="btn btn-primary">{{ __('section_t.Save Change') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="modal fade" id="delete{{ $ray_employee->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        {{ trans('RayEmployee.Delete Employee') }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('RayEmployee.destroy', $ray_employee->id) }}"
                                                    method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <input type="hidden" name="id"
                                                            value="{{ $ray_employee->id }}">
                                                    <div class="modal-body">
                                                        {{ __('RayEmployee.Do You Need Delete This Employee') }}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ __('section_t.Cancel') }}</button>
                                                        <button type="submit"
                                                            class="btn btn-danger">{{ __('doctor.Delete Information') }}</button>
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

        {{-- @include('Dashboard.ray_employee.add') --}}
        <!-- /row -->

    </div>
    <!-- row closed -->

    <!-- Container closed -->

    <!-- main-content closed -->
@endsection

@section('js')
    @include('Dashboard.notify_script')
@endsection
