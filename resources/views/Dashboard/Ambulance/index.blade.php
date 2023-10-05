@extends('Dashboard.layouts.master')
@section('css')
    <link href="{{URL::asset('dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">{{ __('Ambulance.Ambulance') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('Ambulance.Ambulance Car') }} </span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row opened -->
				<div class="row row-sm">
					<!--div-->
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
                                    <a href="{{ route('Ambulances.create') }}" class="btn btn-primary">{{ __('Ambulance.Add Ambulance') }}</a>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
												<th>#</th>
                                                <th>{{ __('Ambulance.Car Number') }}</th>
                                                <th>{{ __('Ambulance.Car Model') }}</th>
                                                <th>{{ __('Ambulance.Car Year Made') }}</th>
                                                <th>{{ __('Ambulance.Car Type') }}</th>
                                                <th>{{ __('Ambulance.Driver Name') }}</th>
                                                <th>{{ __('Ambulance.Driver License Number') }}</th>
                                                <th>{{ __('Ambulance.Driver Phone') }}</th>
                                                <th>{{ __('Ambulance.status') }}</th>
                                                <th>{{ __('Ambulance.notes') }}</th>
                                                <th>{{ __('Ambulance.Processes') }}</th>
											</tr>
										</thead>
										<tbody>
                                        @foreach($ambulances as $ambulance)
											<tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$ambulance->car_number}}</td>
                                                <td>{{$ambulance->car_model}}</td>
                                                <td>{{$ambulance->car_year_made}}</td>
                                                <td>{{$ambulance->car_type == 1 ? 'مملكوكة' :'ايجار'}}</td>
                                                <td>{{$ambulance->driver_name}}</td>
                                                <td>{{$ambulance->driver_license_number}}</td>
                                                <td>{{$ambulance->driver_phone}}</td>
                                                <td>{{$ambulance->is_available == 1 ? 'مفعلة':'غير مفعلة'}}</td>
                                                <td>{{$ambulance->notes}}</td>
                                                <td>
                                                    <a href="{{ route('Ambulances.edit',$ambulance->id) }}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#Deleted{{$ambulance->id}}"><i class="fas fa-trash"></i></button>
                                                </td>
											</tr>


                                            <div class="modal fade" id="Deleted{{$ambulance->id}}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">
                                                                {{ trans('Ambulance.Delete Ambulance') }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('Ambulances.destroy', $ambulance->id) }}"
                                                            method="post">
                                                            @method('delete')
                                                            @csrf
                                                            <div class="modal-body">
                                                                <input type="hidden" name="id"
                                                                    value="{{ $ambulance->id }}">
                                                                <h5>{{ __('Ambulance.Do Uou Need Delete This Ambulance') }}</h5>
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
							</div><!-- bd -->
						</div><!-- bd -->
					</div>
					<!--/div-->
				</div>
				<!-- /row -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
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
