<a class="btn btn-primary pull-right" type="button" href="{{ route('GroupInvoices.create') }}">{{ __('invoices.Add Invoice') }}
</a><br><br>
<div class="card-body">
    <div class="table-responsive">
    <table id="example" class="table key-buttons text-md-nowrap">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('service.Name') }}</th>
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
            @foreach ($Groups as $Group)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $Group->Group->name }}</td>
                    <td>{{ $Group->Patient->name }}</td>
                    <td>{{ $Group->invoice_date }}</td>
                    <td>{{ $Group->Doctor->name }}</td>
                    <td>{{ $Group->Section->name }}</td>
                    <td>{{ number_format($Group->price, 2) }}</td>
                    <td>{{ number_format($Group->discount_value, 2) }}</td>
                    <td>{{ $Group->tax_rate }}%</td>
                    <td>{{ number_format($Group->tax_value, 2) }}</td>
                    <td>{{ number_format($Group->total_with_tax, 2) }}</td>
                    <td>{{ $Group->type == 1 ? __('invoices.Cash') : __('invoices.Delayed') }}</td>
                    <td>
                        <a href="{{ route('GroupInvoices.edit',$Group->id) }}" class="btn btn-primary btn-sm"><i
                                class="fa fa-edit"></i></a>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                            data-target="#deleteGroup{{ $Group->id }}"><i class="fa fa-trash"></i></button>
                        <a class="btn btn-sm btn-success" href="{{ route('GroupInvoices.show', $Group->id) }}"
                            target="_blank" title="{{ __('invoices.Print Invoice') }}"><i class="las la-print"></i></a>
                    </td>
                </tr>


                <div class="modal fade" id="deleteGroup{{ $Group->id }}" tabindex="-1" role="dialog"
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
                            <form action="{{ route('GroupInvoices.destroy', $Group->id) }}" method="post">
                                @method('delete')
                                @csrf
                                <div class="modal-body">
                                    <input type="hidden" name="id" value="{{ $Group->id }}">
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
