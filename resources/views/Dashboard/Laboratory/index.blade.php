@extends('Dashboard.layouts.master')
@section('css')
    @include('Dashboard.notify_css')
@endsection
@section('title')
    {{ __('side_bar.Laboratory') }}
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('side_bar.Laboratory') }}</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('side_bar.Employee List') }}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
@include('Dashboard.messages_alert')
    <div class="row row-sm">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <!-- Button trigger modal -->
                    <a type="button" class="btn btn-primary" href="{{ route('Laboratorys.create') }}">
                        {{ __('RayEmployee.Add New Employee') }}
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table style="text-align: center" class="table text-md-nowrap" id="example1">
                            <thead>
                                <tr>
                                    <th >#</th>
                                    <th >{{ __('doctor.Name') }}</th>
                                    <th >{{ __('doctor.Email') }}</th>
                                    <th>{{ __('doctor.Added Date') }}</th>
                                    <th>{{ __('service.Operation') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($laboratories as $laboratory)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $laboratory->name }}</td>
                                        <td>{{ $laboratory->email }}</td>
                                        <td>{{ $laboratory->created_at->diffForHumans() }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button aria-expanded="false" aria-haspopup="true"
                                                    class="btn ripple btn-outline-primary btn-sm" data-toggle="dropdown"
                                                    type="button">{{ __('doctor.Operation') }}<i
                                                        class="fas fa-caret-down mr-1"></i></button>
                                                <div class="dropdown-menu tx-13">
                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                    data-target="#edit{{ $laboratory->id }}"><i
                                                            style="color: #0ba360"class="text-success ti-user"></i>&nbsp;&nbsp;{{ __('doctor.Edit Information') }}</a>
                                                    <a class="dropdown-item" href="" data-toggle="modal"
                                                        data-target="#delete{{ $laboratory->id }}"><i
                                                            class="text-danger  ti-trash"></i>&nbsp;&nbsp;{{ __('doctor.Delete Information') }}</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="edit{{ $laboratory->id }}" tabindex="-1" role="dialog"
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
                                                <form action="{{ route('Laboratorys.update', $laboratory->id) }}"
                                                    method="post">
                                                    @method('put')
                                                    @csrf
                                                    <input type="hidden" name="id"
                                                            value="{{ $laboratory->id }}">
                                                    <div class="modal-body">
                                                        <div>
                                                            <label for="">{{ __('doctor.Name') }}</label>
                                                            <input type="text" placeholder="Name" name="name"
                                                                class="form-control" value="{{ $laboratory->name }}" required>
                                                        </div>
                                                        <div>
                                                            <label for="">{{ __('doctor.Email') }}</label>
                                                            <input type="email" placeholder="Email" name="email"
                                                                class="form-control" required value="{{ $laboratory->email }}">
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


                                    <div class="modal fade" id="delete{{ $laboratory->id }}" tabindex="-1" role="dialog"
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
                                                <form action="{{ route('Laboratorys.destroy', $laboratory->id) }}"
                                                    method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <input type="hidden" name="id"
                                                            value="{{ $laboratory->id }}">
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
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    @include('Dashboard.notify_script')
@endsection
