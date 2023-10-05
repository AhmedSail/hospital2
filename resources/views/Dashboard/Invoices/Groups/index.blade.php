@extends('Dashboard.layouts.master')
@section('css')
@endsection
@section('title')
    {{ __('side_bar.Single Service Invoice') }}
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('side_bar.Invoices') }}</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('invoices.Single Service Invoice') }}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    <div class="row row-sm">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    @include('Dashboard.Invoices.Groups.Table')
                </div>
            </div>
        </div>
    </div>

    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
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
