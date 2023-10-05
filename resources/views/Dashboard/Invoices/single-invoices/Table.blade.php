<a class="btn btn-primary pull-right" type="button" href="{{ route('Invoices.create') }}">{{ __('invoices.Add Invoice') }}
</a><br><br>
<div class="card-body">
    <div class="table-responsive">
    <table id="example" class="table key-buttons text-md-nowrap">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('service.Service Name') }}</th>
                <th>{{ __('Patient.Patient Name') }}</th>
                <th>{{ __('invoices.invoice date') }}</th>
                <th>{{ __('doctor.Doctor Name') }}</th>
                <th>{{ __('section_t.اسم القسم') }}</th>
                <th>{{ __('service.Price') }}</th>
                <th>{{ __('invoices.Discount Value') }}</th>
                <th>{{ __('invoices.Tax Rate') }}</th>
                <th>{{ __('invoices.Tax Value') }}</th>
                <th>{{ __('invoices.Total with Tax') }}</th>
                <th>{{ __('invoices.Type Of Invoice') }}</th>
                <th>{{ __('Insurance.Processes') }}</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($single_invoices as $single_invoice)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $single_invoice->Service->name }}</td>
                    <td>{{ $single_invoice->Patient->name }}</td>
                    <td>{{ $single_invoice->invoice_date }}</td>
                    <td>{{ $single_invoice->Doctor->name }}</td>
                    <td>{{ $single_invoice->Section->name }}</td>
                    <td>{{ number_format($single_invoice->price, 2) }}</td>
                    <td>{{ number_format($single_invoice->discount_value, 2) }}</td>
                    <td>{{ $single_invoice->tax_rate }}%</td>
                    <td>{{ number_format($single_invoice->tax_value, 2) }}</td>
                    <td>{{ number_format($single_invoice->total_with_tax, 2) }}</td>
                    <td>{{ $single_invoice->type == 1 ? __('invoices.Cash') : __('invoices.Delayed') }}</td>
                    <td>
                        <a href="{{ route('Invoices.edit', $single_invoice->id) }}" class="btn btn-primary btn-sm"><i
                                class="fa fa-edit"></i></a>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                            data-target="#deleteGroup{{ $single_invoice->id }}"><i class="fa fa-trash"></i></button>
                        <a class="btn btn-sm btn-success" href="{{ route('Invoices.show', $single_invoice->id) }}"
                            target="_blank" title="{{ __('invoices.Print Invoice') }}"><i class="las la-print"></i></a>
                    </td>
                </tr>


                <div class="modal fade" id="deleteGroup{{ $single_invoice->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    {{ trans('invoices.Delete Invoice') }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('Invoices.destroy', $single_invoice->id) }}" method="post">
                                @method('delete')
                                @csrf
                                <div class="modal-body">
                                    <input type="hidden" name="id" value="{{ $single_invoice->id }}">
                                    <h5>{{ __('invoices.Do Uou Need Delete This Invoice') }}</h5>
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

    </table>
</div>
</div>
