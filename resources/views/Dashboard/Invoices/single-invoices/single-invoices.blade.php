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
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('Invoices.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label>{{ __('Patient.Patient Name') }}</label>
                                <select name="Patients" class="form-control" required>
                                    <option value="" selected disabled>-- {{ __('main.Select from list') }} --
                                    </option>
                                    @foreach ($Patients as $Patient)
                                        <option value="{{ $Patient->id }}">{{ $Patient->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="col">
                                <label>{{ __('doctor.Doctor Name') }}</label>
                                <select name="Doctors" class="form-control" id="doctorSelect" required>
                                    <option value="" selected disabled>-- {{ __('main.Select from list') }} --
                                    </option>
                                    @foreach ($Doctors as $Doctor)
                                        <option value="{{ $Doctor->id }}" data-section-id="{{ $Doctor->section->id }}">
                                            {{ $Doctor->name }} ({{ $Doctor->section->name }})</option>
                                    @endforeach
                                </select>
                            </div>



                            <input name="Sections" type="hidden" class="form-control" readonly id="sectionInput">



                            <div class="col">
                                <label>{{ __('invoices.Type Of Invoice') }}</label>
                                <select name="type_of_invoice" class="form-control">
                                    <option value="" selected disabled>-- {{ __('main.Select from list') }} --
                                    </option>
                                    <option value="1">{{ __('invoices.Cash') }}</option>
                                    <option value="2">{{ __('invoices.Delayed') }}</option>
                                </select>
                            </div>


                        </div><br>

                        <div class="row row-sm">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-header pb-0">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="card-title mg-b-0"></h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped mg-b-0 text-md-nowrap"
                                                style="text-align: center">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>{{ __('service.Name') }}</th>
                                                        <th>{{ __('service.Price') }}</th>
                                                        <th>{{ __('invoices.Discount Value') }}</th>
                                                        <th>{{ __('invoices.Tax Rate') }}</th>
                                                        <th>{{ __('invoices.Tax Value') }}</th>
                                                        <th>{{ __('invoices.Total with Tax') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">1</th>
                                                        <td>
                                                            <select name="Services" id="ServiceSelect" class="form-control">
                                                                <option value="" selected disabled>--
                                                                    {{ __('main.Select from list') }} --</option>
                                                                @foreach ($Services as $Service)
                                                                    @if ($Service->status == 1)
                                                                        <option value="{{ $Service->id }}"
                                                                            data-price="{{ $Service->price }}">
                                                                            {{ $Service->name }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td><input name="priceInput" id="servicePrice" type="text"
                                                                class="form-control" readonly></td>
                                                        <td><input name="dis_value" id="discountInput" type="text"
                                                                class="form-control" value="0"></td>
                                                        <td><input id="taxInput" name="tax_rate" type="text"
                                                                class="form-control" value="0"></td>
                                                        <td><input id="taxValue" type="text" class="form-control"
                                                                readonly></td>

                                                        <td><input id="totalWithTax" type="text" class="form-control"
                                                                readonly value="#"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div><!-- bd -->
                                    </div><!-- bd -->
                                </div><!-- bd -->
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <button class="btn btn-success">{{ trans('doctor.submit') }}</button>
                            </div>
                        </div>
                    </form>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // استدعاء الدالة عند تغيير القيمة في القائمة المنسدلة
        $('#doctorSelect').change(function() {
            // الحصول على القيمة المحددة في القائمة المنسدلة
            var selectedDoctorId = $(this).val();

            // الحصول على الـ ID التابع للقسم وتعيينه في حقل الإدخال
            var selectedSectionId = $('#doctorSelect option:selected').data('section-id');
            $('#sectionInput').val(selectedSectionId);
        });
    </script>

    <script>
        // احصل على القائمة المنسدلة وحقل الإدخال
        var serviceSelect = document.getElementById('ServiceSelect');
        var priceInput = document.getElementById('priceInput');

        // أضف حدث تغيير إلى القائمة المنسدلة
        serviceSelect.addEventListener('change', function() {
            // احصل على السعر من الخاصية data-price للخدمة المحددة
            var selectedService = serviceSelect.options[serviceSelect.selectedIndex];
            var price = selectedService.getAttribute('data-price');

            // قم بتحديث حقل الإدخال بالسعر
            priceInput.value = price;
        });
    </script>
    <script>
        $(document).ready(function() {
            // حساب الإجمالي قبل الخصم
            function calculateTotalBeforeDiscount(servicePrice) {
                return parseFloat(servicePrice);
            }

            // حساب الإجمالي بعد الخصم
            function calculateTotalAfterDiscount(servicePrice, discount) {
                var totalAfterDiscount = servicePrice - discount;
                return (totalAfterDiscount < 0) ? 0 : totalAfterDiscount;
            }

            // حساب الإجمالي بعد إضافة الضريبة
            function calculateTotalWithTax(totalAfterDiscount, tax) {
                var totalWithTax = totalAfterDiscount + (totalAfterDiscount * tax / 100);
                return totalWithTax;
            }

            // عند تغيير الخدمة المختارة
            $('#ServiceSelect').on('change', function() {
                var selectedOption = $('#ServiceSelect option:selected');
                var servicePrice = parseFloat(selectedOption.attr(
                    'data-price')); // السعر من البيانات الإضافية

                $('#servicePrice').val(servicePrice); // عرض السعر في حقل السعر

                // حساب الإجمالي بعد الخصم
                var discount = parseFloat($('#discountInput').val()) || 0;
                var totalAfterDiscount = calculateTotalAfterDiscount(servicePrice, discount);
                $('#totalWithTax').val(totalAfterDiscount);

                // حساب الضريبة
                var tax = parseFloat($('#taxInput').val()) || 0; // القيمة المدخلة لنسبة الضريبة
                var taxValue = (totalAfterDiscount * tax) / 100; // حساب القيمة الفعلية للضريبة

                // عرض القيمة النسبية للضريبة
                $('#taxValue').val(taxValue.toFixed(2));

                // حساب الإجمالي بعد إضافة الضريبة
                var totalWithTax = totalAfterDiscount + taxValue;
                $('#totalWithTax').val(totalWithTax.toFixed(2));
            });


            // عند تغيير القيمة المدخلة للخصم
            $('#discountInput').on('input', function() {
                var selectedOption = $('#ServiceSelect option:selected');
                var servicePrice = parseFloat(selectedOption.data('price')); // السعر من البيانات الإضافية

                // حساب الإجمالي بعد الخصم
                var discount = parseFloat($(this).val()) || 0;
                var totalAfterDiscount = calculateTotalAfterDiscount(servicePrice, discount);
                $('#totalWithTax').val(totalAfterDiscount);

                // حساب الضريبة
                var tax = parseFloat($('#taxInput').val()) || 0; // القيمة المدخلة لنسبة الضريبة
                var taxValue = (totalAfterDiscount) * tax / 100; // حساب القيمة الفعلية للضريبة

                // عرض القيمة النسبية للضريبة
                $('#taxValue').val(taxValue.toFixed(2));

                // حساب الإجمالي بعد إضافة الضريبة
                var totalWithTax = totalAfterDiscount + taxValue;
                $('#totalWithTax').val(totalWithTax.toFixed(2));
            });

            // عند تغيير القيمة المدخلة لنسبة الضريبة
            $('#taxInput').on('input', function() {
                var selectedOption = $('#ServiceSelect option:selected');
                var servicePrice = parseFloat(selectedOption.data('price')); // السعر من البيانات الإضافية

                // حساب الإجمالي بعد الخصم
                var discount = parseFloat($('#discountInput').val()) || 0;
                var totalAfterDiscount = calculateTotalAfterDiscount(servicePrice, discount);

                // حساب الضريبة
                var tax = parseFloat($(this).val()) || 0; // القيمة المدخلة لنسبة الضريبة
                var taxValue = (totalAfterDiscount * tax) / 100; // حساب القيمة الفعلية للضريبة

                // عرض القيمة النسبية للضريبة
                $('#taxValue').val(taxValue.toFixed(2));

                // حساب الإجمالي بعد إضافة الضريبة
                var totalWithTax = totalAfterDiscount + taxValue;
                $('#totalWithTax').val(totalWithTax.toFixed(2));
            });
        });
    </script>

@endsection
