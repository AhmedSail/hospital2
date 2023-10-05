@extends('Dashboard.layouts.master')
@section('css')
<!--Internal   Notify -->
<link href="{{URL::asset('dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
@endsection
@section('title')
    {{trans('main-sidebar_trans.Insurance')}}
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{trans('side_bar.Service')}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{trans('side_bar.Insurance Companies')}}</span>
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
                <div class="card-header">
                    <a href="{{ route('Insurances.create') }}" class="btn btn-primary">{{trans('Insurance.Add Insurance')}}</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap text-center" id="example1">
                            <thead>
                            <tr class="table-secondary">
                                <th>#</th>
                                <th >{{__('Insurance.Company_code')}}</th>
                                <th >{{trans('Insurance.Company_name')}}</th>
                                <th >{{trans('Insurance.discount_percentage')}}</th>
                                <th >{{trans('Insurance.Insurance_bearing_percentage')}}</th>
                                <th >{{trans('Insurance.status')}}</th>
                                <th >{{trans('Insurance.notes')}}</th>
                                <th >{{trans('Insurance.Processes')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($insurances as $insurance)
                                <tr>
                                    <td>{{$loop->iteration }}</td>
                                    <td>{{$insurance->insurance_code}}</td>
                                    <td>{{$insurance->name}}</td>
                                    <td>{{$insurance->discount_percentage}}</td>
                                    <td>{{$insurance->company_rate}}</td>
                                    <td class="{{$insurance->status == 1 ? 'bg-success':'bg-danger'}}">{{$insurance->status == 1 ? 'مفعل' : 'غير مفعل'}}</td>
                                    <td>{{$insurance->notes}}</td>
                                    <td>
                                        <a href="{{ route('Insurances.edit',$insurance->id) }}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                        <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#Deleted{{$insurance->id}}"><i class="fas fa-trash"></i>
                                        </button>

                                    </td>
                                 {{-- @include('Dashboard.insurance.Deleted') --}}
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="Deleted{{$insurance->id}}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">
                                                    {{ trans('Insurance.Delete Insurance') }}</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('Insurances.destroy', $insurance->id) }}"
                                                method="post">
                                                @method('delete')
                                                @csrf
                                                <div class="modal-body">
                                                    <input type="hidden" name="id"
                                                        value="{{ $insurance->id }}">
                                                    <h5>{{ __('Insurance.Do Uou Need Delete This Insurance') }}</h5>
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
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')

    <!--Internal  Notify js -->
    <script src="{{URL::asset('dashboard/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('/plugins/notify/js/notifit-custom.js')}}"></script>
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
