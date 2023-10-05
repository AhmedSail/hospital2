@extends('Dashboard.layouts.master')
@section('css')
<!-- Internal Gallery css -->
<link href="{{ URL::asset('assets/plugins/gallery/gallery.css') }}" rel="stylesheet">
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">{{ __('Patient.Rays')}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">
                / {{ $ray->Patient->name }}</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
    @endsection
@section('content')
    <label for="">{{ __('Patient.notes') }}</label>
    <textarea name="description_employee" rows="3" readonly class="form-control">{{ $ray->description_employee }} </textarea>
    <!-- Gallery -->
    <div class="demo-gallery mt-5">
        <ul id="lightgallery" class="list-unstyled row row-sm pr-0">
            @foreach ($ray->images as $image)
            <li class="col-sm-6 col-lg-4" data-responsive="{{ asset('Dashboard/img/Rays/'.$ray->Patient->name. '/' . $image->filename) }}"
                data-src="{{ asset('Dashboard/img/Rays/'.$ray->Patient->name. '/' . $image->filename) }}">
                <a href="">
                    <img width="50px" height="350px" class="img-responsive"
                        src="{{ asset('Dashboard/img/Rays/'.$ray->Patient->name. '/' . $image->filename) }}">
                </a>
            </li>
            @endforeach
        </ul>
        <!-- /Gallery -->


    </div>
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Gallery js -->
    <script src="{{ URL::asset('assets/plugins/gallery/lightgallery-all.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/gallery/jquery.mousewheel.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/gallery.js') }}"></script>
@endsection
