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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
    <form action="{{ route('GroupService.update', $group->id) }}" method="post" autocomplete="off">
        @csrf
        @method('put')
        <div class="modal-body">
            <div>
                <label for="name">{{ trans('service.Name') }}</label>
                <input type="text" name="name" id="name"
                    class="form-control @error('name')
                        is-invalid
                    @enderror"
                    value="{{ $group->name }}">
                @error('name')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
                <br>
            </div>

            <div>
                <label for="exampleInputEmail1">
                    {{ __('service.Single Services') }}</label>


                    <select name="Services[]"
                    class="js-example-basic-multiple form-control @error('Services')is-invalid @enderror"
                    multiple="multiple">

                    <option disabled>{{ __('doctor.-- حدد المواعيد --') }}</option>
                    @foreach ($services as $service)
                        @if ($service->status == 1)
                            <option {{ $group->service_group->contains($service) ? 'selected' : '' }}
                                data-price="{{ $service->price }}" value="{{ $service->id }}">
                                {{ $service->price }}${{ $service->name }}</option>
                        @endif
                    @endforeach
                </select>
                @error('Services')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>




            <div>
                <label for="">{{ __('service.Total Before Discount') }}</label>
                <input type="text" id="totalBeforeDiscount" class="form-control" disabled value="{{ $group->Total_before_discount }}">

            </div>

            <div>
                <label for="">{{ __('service.Discount Value') }}</label>
                <input type="number" id="discountInput" name="discount" class="form-control @error('discount')
                is-invaild
                @enderror" value="{{ $group->discount_value }}">
                @error('discount')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
            <div>
                <label for="">{{ __('service.Total After Discount') }}</label>
                <input type="text" id="totalAfterDiscount" class="form-control" disabled value="{{ $group->Total_after_discount }}">
            </div>
            <div>
                <label for="">{{ __('service.Tax Value') }}</label>
                <input type="number" id="taxInput" name="tax" class="form-control @error('tax')
                    is-invaild
                @enderror" value="{{ $group->tax_rate }}">
                @error('tax')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>

            <div>
                <label for="">{{ __('service.Total With Tax') }}</label>
                <input type="text" id="totalWithTax" class="form-control" disabled value="{{ $group->Total_with_Tax }}">
            </div>

            <div>
                <label for="description">{{ trans('service.Description') }}</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                    rows="5">{{ $group->notes }}</textarea>
                @error('description')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>

        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('section_t.Cancel') }}</button>
            <button type="submit" class="btn btn-primary">{{ trans('doctor.submit') }}</button>
        </div>
    </form>
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
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();

            // حساب الإجمالي قبل الخصم
            function calculateTotalBeforeDiscount(selectedServices) {
                var totalBeforeDiscount = 0;
                if (selectedServices && selectedServices.length > 0) {
                    for (var i = 0; i < selectedServices.length; i++) {
                        var serviceId = selectedServices[i];
                        var servicePrice = parseFloat($('option[value="' + serviceId + '"]').data('price'));
                        totalBeforeDiscount += servicePrice;
                    }
                }
                return totalBeforeDiscount;
            }

            // حساب الإجمالي بعد الخصم
            function calculateTotalAfterDiscount(totalBeforeDiscount, discount) {
                var totalAfterDiscount = totalBeforeDiscount - discount;
                return (totalAfterDiscount < 0) ? 0 : totalAfterDiscount; // التحقق من أن القيمة لا تكون سالبة
            }

            // حساب الإجمالي بعد إضافة الضريبة
            function calculateTotalWithTax(totalAfterDiscount, tax) {
                var totalWithTax = (totalAfterDiscount * tax / 100) + totalAfterDiscount;
                return totalWithTax;
            }

            // عند تغيير الخدمات المختارة
            $('.js-example-basic-multiple').on('change', function() {
                var selectedServices = $(this).val();
                var totalBeforeDiscount = calculateTotalBeforeDiscount(selectedServices);
                $('#totalBeforeDiscount').val(totalBeforeDiscount);

                // حساب الإجمالي بعد الخصم
                var discount = parseFloat($('#discountInput').val()) || 0; // القيمة المدخلة للخصم
                var totalAfterDiscount = calculateTotalAfterDiscount(totalBeforeDiscount, discount);
                $('#totalAfterDiscount').val(totalAfterDiscount);

                // حساب الإجمالي بعد إضافة الضريبة
                var tax = parseFloat($('#taxInput').val()) || 0; // القيمة المدخلة للضريبة
                var totalWithTax = calculateTotalWithTax(totalAfterDiscount, tax);
                $('#totalWithTax').val(totalWithTax);
            });

            // عند تغيير القيمة المدخلة للخصم
            $('#discountInput').on('input', function() {
                var selectedServices = $('.js-example-basic-multiple').val();
                var totalBeforeDiscount = calculateTotalBeforeDiscount(selectedServices);

                // حساب الإجمالي بعد الخصم
                var discount = parseFloat($(this).val()) || 0;
                var totalAfterDiscount = calculateTotalAfterDiscount(totalBeforeDiscount, discount);
                $('#totalAfterDiscount').val(totalAfterDiscount);

                // حساب الإجمالي بعد إضافة الضريبة
                var tax = parseFloat($('#taxInput').val()) || 0;
                var totalWithTax = calculateTotalWithTax(totalAfterDiscount, tax);
                $('#totalWithTax').val(totalWithTax);
            });

            // عند تغيير القيمة المدخلة للضريبة
            $('#taxInput').on('input', function() {
                var selectedServices = $('.js-example-basic-multiple').val();
                var totalBeforeDiscount = calculateTotalBeforeDiscount(selectedServices);

                // حساب الإجمالي بعد الخصم
                var discount = parseFloat($('#discountInput').val()) || 0;
                var totalAfterDiscount = calculateTotalAfterDiscount(totalBeforeDiscount, discount);
                $('#totalAfterDiscount').val(totalAfterDiscount);

                // حساب الإجمالي بعد إضافة الضريبة
                var tax = parseFloat($(this).val()) || 0;
                var totalWithTax = calculateTotalWithTax(totalAfterDiscount, tax);
                $('#totalWithTax').val(totalWithTax);
            });
        });
    </script>

@endsection
