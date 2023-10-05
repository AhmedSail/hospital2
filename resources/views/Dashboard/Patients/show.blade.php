@extends('Dashboard.layouts.master')
@section('css')
@endsection
@section('title')
    {{ __('Patient.Patient Information') }}
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto d-flex justify-content-space-between align-items-center" style="justify-content: space-between">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('Patient.Patients') }}</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ $Patient->name }}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="card" id="basic-alert">
                <div class="card-body">
                    <div class="panel panel-primary tabs-style-1">
                        <div class="tabs-menu1">
                            <!-- Tabs -->
                            <ul class="nav panel-tabs main-nav-line">
                                <li class="nav-item"><a href="#tab1" class="nav-link active"
                                        data-toggle="tab">{{ __('Patient.Patient Information') }}</a></li>
                                <li class="nav-item"><a href="#tab2" class="nav-link"
                                        data-toggle="tab">{{ __('side_bar.Invoices') }}</a>
                                </li>
                                <li class="nav-item"><a href="#tab3" class="nav-link"
                                        data-toggle="tab">{{ __('side_bar.Finance') }}</a>
                                </li>
                                <li class="nav-item"><a href="#tab4" class="nav-link"
                                        data-toggle="tab">{{ __('Patient.Account Statement') }}</a></li>
                            </ul>
                        </div>
                        <div class="panel-body tabs-menu-body main-content-body-right border-top-0 border">
                            <div class="tab-content">


                                {{-- Strat Show Information Patient --}}

                                <div class="tab-pane active" id="tab1">
                                    <br>
                                    <div class="table-responsive">
                                        <table class="table table-hover text-md-nowrap text-center">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>{{ __('Patient.Patient Name') }}</th>
                                                    <th>{{ __('Patient.Phone') }}</th>
                                                    <th>{{ __('Patient.Email') }}</th>
                                                    <th>{{ __('Patient.Birth Date') }}</th>
                                                    <th>{{ __('Patient.Gender') }}</th>
                                                    <th>{{ __('Patient.Blood Group') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>{{ $Patient->name }}</td>
                                                    <td>{{ $Patient->phone }}</td>
                                                    <td>{{ $Patient->email }}</td>
                                                    <td>{{ $Patient->date_birth }}</td>
                                                    <td>{{ $Patient->gender == 1 ? __('Patient.Male') : __('Patient.Female') }}
                                                    </td>
                                                    <td>{{ $Patient->blood_group }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                {{-- End Show Information Patient --}}



                                {{-- Start Invices Patient --}}

                                <div class="tab-pane" id="tab2">

                                    <div class="table-responsive">
                                        <table class="table table-hover text-md-nowrap text-center">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>{{ __('service.Name') }}</th>
                                                    <th>{{ __('invoices.Issue Date') }}</th>
                                                    <th>{{ __('invoices.Total with Tax') }}</th>
                                                    <th>{{ __('invoices.Type Of Invoice') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($invoices as $invoice)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        @if ($invoice->invoice_type == 1)
                                                            <td>{{ $invoice->Service->name }}</td>
                                                        @else
                                                            <td>{{ $invoice->Group->name }}</td>
                                                        @endif
                                                        <td>{{ $invoice->invoice_date }}</td>
                                                        <td>{{ $invoice->total_with_tax }}</td>
                                                        <td>{{ $invoice->type == 1 ? __('invoices.Cash') : __('invoices.Delayed') }}
                                                        </td>
                                                    </tr>
                                                    <br>
                                                @endforeach
                                                <tr>
                                                    <th colspan="5" scope="row" class="alert alert-success">
                                                        {{ __('main.Total') }}</th>
                                                    </th>
                                                    <td class="alert alert-primary">
                                                        {{ number_format($invoice = $invoices->sum('total_with_tax'), 2) }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                {{-- End Invices Patient --}}



                                {{-- Start Receipt Patient  --}}

                                <div class="tab-pane" id="tab3">
                                    <div class="table-responsive">
                                        <table class="table table-hover text-md-nowrap text-center">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>{{ __('doctor.Added Date') }}</th>
                                                    <th>{{ __('service.Price') }}</th>
                                                    <th>{{ __('Finance.Debit') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($receipt_accounts as $receipt_account)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $receipt_account->date }}</td>
                                                        <td>{{ $receipt_account->amount }}</td>
                                                        <td>{{ $receipt_account->description }}</td>
                                                    </tr>
                                                    <br>
                                                @endforeach
                                                <tr>
                                                    <th scope="row" class="alert alert-success">
                                                        {{ __('main.Total Of Payments') }}
                                                    </th>
                                                    <td colspan="4" class="alert alert-primary">
                                                        {{ number_format($receipt_accounts->sum('amount'), 2) }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                {{-- End Receipt Patient  --}}


                                {{-- Start payment accounts Patient --}}
                                <div class="tab-pane" id="tab4">
                                    <div class="table-responsive">
                                        <table class="table table-hover text-md-nowrap text-center" id="example1">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>{{ __('doctor.Added Date') }}</th>
                                                    <th>{{ __('Patient.notes') }}</th>
                                                    <th>{{ __('Patient.debit') }}</th>
                                                    <th>{{ __('Patient.credit') }}</th>
                                                    <th>{{ __('Patient.Final Balance') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($Patient_accounts as $Patient_account)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $Patient_account->date }}</td>
                                                        <td>
                                                            @if ($Patient_account->invoice == true)
                                                                @if ($Patient_account->invoice->invoice_type==1)
                                                                {{ $Patient_account->invoice->Service->name }}
                                                                @else
                                                                {{ $Patient_account->invoice->Group->name }}
                                                                @endif
                                                            @elseif($Patient_account->receipt_id == true)
                                                                {{ $Patient_account->ReceiptAccount->description }}
                                                            @elseif($Patient_account->payment_id == true)
                                                                {{ $Patient_account->PaymentAccount->description }}
                                                            @endif

                                                        </td>
                                                        <td>{{ $Patient_account->debit }}</td>
                                                        <td>{{ $Patient_account->credit }}</td>
                                                        <td></td>
                                                    </tr>
                                                    <br>
                                                @endforeach
                                                <tr>
                                                    <th colspan="3" scope="row" class="alert alert-success">
                                                        {{ __('main.Total') }}
                                                    </th>
                                                    <td class="alert alert-primary">
                                                        {{ number_format($debit = $Patient_accounts->sum('debit'), 2) }}
                                                    </td>
                                                    <td class="alert alert-primary">
                                                        {{ number_format($credit = $Patient_accounts->sum('credit'), 2) }}
                                                    </td>
                                                    <td class="alert alert-danger">
                                                        @if (number_format($debit - $credit, 2) == 0)
                                                            <span class="text-danger"> {{ number_format($debit - $credit, 2) }}
                                                            </span>
                                                        @else
                                                            <span class="text-danger">
                                                                {{ number_format($debit - $credit, 2) }}

                                                                {{ $debit - $credit > 0 ? __('Patient.debit') : __('Patient.credit') }}
                                                            </span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>

                                    <br>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


    </div>
    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
@endsection
@section('js')
@endsection
