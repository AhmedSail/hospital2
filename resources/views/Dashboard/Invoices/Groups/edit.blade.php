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
                    <form action="{{ route('GroupInvoices.update', $Group->id) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col">
                                <label>{{ __('Patient.Patient Name') }}</label>
                                <select name="Patients" class="form-control" required>
                                    <option value="" selected disabled>-- {{ __('main.Select from list') }} --
                                    </option>
                                    @foreach ($Patients as $Patient)
                                        <option {{ $Group->patient_id== $Patient->id ? 'selected' : '' }}
                                            value="{{ $Patient->id }}">{{ $Patient->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="col">
                                <label>{{ __('doctor.Doctor Name') }}</label>
                                <select name="Doctors" class="form-control" id="doctorSelect" required>
                                    <option value="" selected disabled>-- {{ __('main.Select from list') }} --
                                    </option>
                                    @foreach ($Doctors as $Doctor)
                                        <option {{ $Group->doctor_id == $Doctor->id ? 'selected' : '' }}
                                            value="{{ $Doctor->id }}" data-section-id="{{ $Doctor->section->id }}">
                                            {{ $Doctor->name }} ({{ $Doctor->section->name }})</option>
                                    @endforeach
                                </select>
                            </div>



                            <input name="Sections" type="hidden" class="form-control" readonly id="sectionInput">



                            <div class="col">
                                <label>{{ __('invoices.Type Of Invoice') }}</label>
                                <select name="type_of_invoice" class="form-control" disabled>
                                    <option selected disabled>-- {{ __('main.Select from list') }} --
                                    </option>
                                    <option {{ $Group->type == 1 ? 'selected' : '' }} value="1">
                                        {{ __('invoices.Cash') }}</option>
                                    <option {{ $Group->type == 2 ? 'selected' : '' }} value="2">
                                        {{ __('invoices.Delayed') }}</option>
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
                                                            <select name="Groups" id="GroupSelect" class="form-control">
                                                                <option value="" disabled>-- {{ __('main.Select from list') }} --</option>
                                                                @foreach ($Groups as $group)
                                                                    <option value="{{ $group->id }}"
                                                                        data-price="{{ $group->Total_before_discount }}"
                                                                        data-discount="{{ $group->discount_value }}"
                                                                        data-tax="{{ $group->tax_rate }}"
                                                                        {{ $Group->id == $group->id ? 'selected' : '' }}>
                                                                        {{ $group->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>


                                                        </td>
                                                        <td><input name="priceInput" id="GroupPrice" type="text"
                                                                class="form-control" readonly value="{{ $Group->price }}"></td>
                                                        <td><input name="dis_value" id="discountInput" type="text" value="{{ $Group->discount_value}}"
                                                                class="form-control" readonly></td>
                                                        <td><input value="{{ $Group->tax_rate }}" id="taxInput" name="tax_rate" type="text"
                                                                class="form-control" readonly></td>
                                                        <td><input value="{{ $Group->tax_value }}" name="tax_value" id="taxValue" type="text" class="form-control"
                                                                readonly ></td>

                                                        <td><input value="{{ $Group->total_with_tax }}" name="total_with_tax" id="totalWithTax" type="text" class="form-control"
                                                                readonly></td>
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
        var GroupSelect = document.getElementById('GroupSelect');
        var priceInput = document.getElementById('GroupPrice');
        var discountInput = document.getElementById('discountInput');
        var taxInput = document.getElementById('taxInput');
        var taxValueInput = document.getElementById('taxValue');
        var totalWithTaxInput = document.getElementById('totalWithTax');

        // أضف حدث تغيير إلى القائمة المنسدلة
        GroupSelect.addEventListener('change', function() {
            // احصل على البيانات من الخدمة المحددة
            var selectedService = GroupSelect.options[GroupSelect.selectedIndex];
            var price = parseFloat(selectedService.getAttribute('data-price'));
            var discount = parseFloat(selectedService.getAttribute('data-discount'));
            var taxRate = parseFloat(selectedService.getAttribute('data-tax'));

            // حساب قيمة الضريبة بناءً على النسبة
            var taxValue = (price - discount) * (taxRate / 100);
            var totalWithTax = price - discount + taxValue;

            // عرض البيانات في الحقول المناسبة
            priceInput.value = price.toFixed(2);
            discountInput.value = discount.toFixed(2);
            taxInput.value = taxRate.toFixed(2);
            taxValueInput.value = taxValue.toFixed(2);
            totalWithTaxInput.value = totalWithTax.toFixed(2);
        });
    </script>


@endsection
