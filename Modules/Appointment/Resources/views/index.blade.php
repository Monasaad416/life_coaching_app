@extends('layout.master')

@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">{{trans('admin.appointments')}}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('coach.index')}}" class="default-color">{{ trans('admin.home') }}</a></li>
                    <li class="breadcrumb-item active">{{ trans('admin.available_appointments') }}</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
				<!-- row opened -->
				<div class="row row-sm">
					<!--div-->

                    @include('inc.messages')
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">{{trans('admin.appointments')}}</h4>
									@can('create_appointment_coach')
                                        <button class="btn btn-primary"><a class="x-small text-white" href="{{route("coach.appointment.create")}}">{{trans('admin.create_appointment')}}</a></button>
									@endcan
								</div>
								{{-- <p class="tx-12 tx-gray-500 mb-2">Example of Valex Hoverable Rows Table.. <a href="">Learn more</a></p> --}}
							</div>
							<div class="card-body">
								<div class="table-responsive">

                                    {{-- Search for coaches --}}
                                    @if(auth('admin')->check())
                                        <style>
                                            .search {
                                                background-color : #edf0f9;
                                            }
                                        </style>
                                        <input type="text" id="search" class="form-control my-4 search" name="search" placeholder="{{trans('admin.search_by_coach')}}">
                                    @endif

									<table class="table table-hover mb-0 text-md-nowrap" >
										<thead>
											<tr>
												<th>#</th>
												<th>{{trans('admin.day')}}</th>
                                                <th>{{trans('admin.from')}}</th>
                                                <th>{{trans('admin.to')}}</th>
                                                @if(auth('admin')->check())
                                                    <th>{{trans('admin.coach')}}</th>
                                                @endif
												@can('edit_appointment_coach')
                                                <th>{{trans('admin.edit')}}</th>
												@endcan
												@can('delete_appointment_coach')
                                                <th>{{trans('admin.delete')}}</th>
												@endcan
											</tr>
										</thead>
										<tbody id="filtered-results">
                                            @foreach ($appointments as $appointment )
                                                @php
                                                    if($appointment->day =="Saturday"){
                                                        $day = App::getLocale() == "en" ? 'Saturday' : 'السبت';
                                                    }
                                                    if($appointment->day =="Sunday"){
                                                        $day = App::getLocale() == "en" ? 'Sunday' : 'الأحد';
                                                    }
                                                    if($appointment->day =="Monday"){
                                                        $day = App::getLocale() == "en" ? 'Monday' : 'الإثنين';
                                                    }
                                                    if($appointment->day =="Tuesday"){
                                                        $day = App::getLocale() == "en" ? 'Tuesdat' : 'الثلاثاء';
                                                    }
                                                    if($appointment->day =="Wednesday"){
                                                        $day = App::getLocale() == "en" ? 'Wednesday' : 'الأربعاء';
                                                    }
                                                    if($appointment->day =="Thursday"){
                                                        $day = App::getLocale() == "en" ? 'Thursday' : 'الخميس';
                                                    }
                                                    if($appointment->day =="Friday"){
                                                        $day = App::getLocale() == "en" ? 'Friday' : 'الجمعة';
                                                    }
                                                @endphp
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $day}}</td>
                                                    <td>{{ $appointment->from}}</td>
                                                    <td>{{ $appointment->to}}</td>
                                                    @if(auth('admin')->check())
                                                        <td>{{ $appointment->coach->name}}</td>
                                                    @endif

													@can('edit_appointment_coach')
                                                        <td>
                                                            <a href="{{route('coach.appointment.edit',$appointment->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true" title="تحديث التصنيف"><i class="fa fa-edit"></i></a>
                                                        </td>
													@endcan

                                                   @can('delete_appointment_coach')
                                                    <td>
                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_appointment{{ $appointment->id }}" title="حذف التصنيف"><i class="fa fa-trash"></i></button></td>
                                                         <!-- Delete Modal -->
                                                        <form action="{{route('coach.appointment.destroy',$appointment)}}" method="POST">
                                                            <div class="modal fade" id="delete_appointment{{$appointment->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">{{ trans('admin.delete_appointment') }}</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>{{trans('admin.sure_delete_appointment')}}</p>

                                                                            @csrf
                                                                            {{-- {{method_field('delete')}} --}}
                                                                            <input type="hidden" value="{{$appointment->id}}" name="id">
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                                                                                <button type="submit" name="submit" class="btn btn-danger">حذف</button>
                                                                            </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </td>
													@endcan
                                                </tr>
                                            @endforeach


										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!--/div-->
				</div>
				<!-- /row -->


				     <div class="d-flex justify-content-center align-items-center my-5">

                </div>
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')

<script>
    $(document).ready(function () {
        $('#search').on('input', function () {
            var query = $(this).val();
            $('#filtered-results').empty();

            $.ajax({
                type: 'GET',
                url: '{{ route('admin.appointment.filtered.appointments') }}',
                data: { query: query },
                success: function (data) {
                    console.log(data.appointments);
                        $.each(data.appointments, function (key, value) {
                            $('#filtered-results').append('<tr><td>'+ (key+1) +'</td><td>'+value.day+'</td><td>'+value.from+'</td><td>'+value.to+'</td><td>'+data.coach+'</td></tr>');
                        });
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });
    });
</script>
@endsection
