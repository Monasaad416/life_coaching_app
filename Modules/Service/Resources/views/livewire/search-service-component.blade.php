		<div class="row row-sm">
					<!--div-->

                    @include('inc.messages')
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">{{trans('admin.services')}}</h4>
									@can('create_service_coach')
                                        <button class="btn btn-primary"><a class="x-small text-white" href="{{route("coach.service.create")}}">{{trans('admin.create_service')}}</a></button>
									@endcan
								</div>
								{{-- <p class="tx-12 tx-gray-500 mb-2">Example of Valex Hoverable Rows Table.. <a href="">Learn more</a></p> --}}
							</div>
							<div class="card-body">
								<div class="table-responsive">
                                    @if(Auth::guard('admin')->check())

                                        <!-- Search for services -->
                                        <style>
                                            .search {
                                                background-color : #edf0f9;
                                            }
                                        </style>
                                        <input type="text"  class="form-control my-4 search" wire:model="search_by_service" placeholder="{{trans('admin.search_by_service')}}">
									@endif
                                        <table class="table table-hover mb-0 text-md-nowrap">
										<thead>
											<tr>
												<th>#</th>
												<th>{{ trans('admin.service') }} </th>
                                                <th>{{ trans('admin.category') }} </th>
                                                <th>{{ trans('admin.type') }} </th>
                                                <th>{{ trans('admin.price') }} </th>
                                                <th>{{ trans('admin.discount_price') }} </th>
                                                <th>{{ trans('admin.shipping_price') }} </th>
                                                <th>{{ trans('admin.duration') }} </th>
                                                @if(auth('admin')->check())
                                                    <th>{{ trans('admin.coach') }} </th>
                                                @endif
                                                @can('show_service')
                                                    <th>{{ trans('admin.show') }}</th>
                                                @endcan
                                                @can('show_service_coach')
                                                    <th>{{ trans('admin.show') }}</th>
                                                @endcan
                                                @can('edit_service_coach')
                                                     <th>{{ trans('admin.edit') }}</th>
												@endcan
												@can('delete_service')
                                                     <th>{{ trans('admin.delete') }}</th>
												@endcan
                                                @can('delete_service_coach')
                                                     <th>{{ trans('admin.delete') }}</th>
												@endcan

											</tr>
										</thead>
										<tbody id="filtered-results">
                                            @foreach ($services as $service )
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $service->name }}</td>
                                                    @php
                                                        $locale = LaravelLocalization::getCurrentLocale() ;
                                                        if ($locale == "ar" && $service->type == 'service'){
                                                            $type = 'خدمة' ;
                                                        }elseif ($locale == "ar" && $service->type == 'product'){
                                                            $type = 'منتج' ;
                                                        }elseif ($locale == "en" && $service->type == 'service'){
                                                            $type = 'Service' ;
                                                        }elseif ($locale == "en" && $service->type == 'product'){
                                                            $type = 'Product' ;
                                                        }

                                                    @endphp
                                                    <td>{{ $service->category->name }}</td>
                                                    <td>{{ $type}}</td>
                                                    <td>{{ $service->price }}</td>
                                                    <td>{{ $service->discount_price ? $service->discount_price : 0}}</td>
                                                    <td>{{ $service->shipping_price ?  $service->shipping_price : trans('admin.not_found')}}</td>
                                                    <td>{{ $service->duration ? $service->duration : trans('admin.not_found') }}</td>
                                                    @if(auth('admin')->check())
                                                        <th>{{  $service->coach->name }} </th>
                                                    @endif

                                                    @can('show_service_coach')
                                                        <td>
                                                            <a href="{{route('coach.service.show',$service->id)}}" class="btn btn-secondary btn-sm" role="button" aria-pressed="true" title="{{trans('admin.service_details')}}"><i class="fa fa-eye text-white" aria-hidden="true"></i></a>
                                                        </td>
                                                    @endcan

                                                    @can('show_service')
                                                        <td>
                                                            <a href="{{route('admin.service.show',$service->id)}}" class="btn btn-secondary btn-sm" role="button" aria-pressed="true" title="{{trans('admin.service_details')}}"><i class="fa fa-eye text-white" aria-hidden="true"></i></a>
                                                        </td>
                                                    @endcan
                                                    {{-- <td>{{ $service->specialist->name_ar }}</td> --}}
													@can('edit_service_coach')
                                                        <td>
                                                            <a href="{{route('coach.service.edit',$service->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true" title="{{trans('admin.update')}}"><i class="fa fa-edit text-white" aria-hidden="true"></i></a>
                                                        </td>
													@endcan

                                                    @can('delete_service_coach')
                                                        <td>
                                                            {{-- <a href ="{{route('coach.service.delete.view',$service->id)}}"  class="btn btn-danger btn-sm" title="{{trans('admin.delete')}}"><i class="fa fa-trash"></i></a> --}}
                                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_service{{ $service->id }}" title="حذف الطبيب"><i class="fa fa-trash"></i></button></td>
                                                             <form action="{{route('coach.service.destroy',$service)}}" method="POST">
                                                                <div class="modal fade" id="delete_service{{$service->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">{{ trans('admin.delete_service') }}</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                        </div>
                                                                        <div class="modal-body">     

                                                                            <p>{{ trans('admin.confirm_delete')}} {{ $service->name }}</p>
                                                                                @csrf

                                                                                <input type="hidden" value="{{$service->id}}" name="service_id">
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

                                                    @can('delete_service')
                                                        <td>
                                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_service{{ $service->id }}" title="حذف الطبيب"><i class="fa fa-trash"></i></button></td>

                                                            <form action="{{route('admin.service.destroy',$service)}}" method="POST">
                                                                <div class="modal fade" id="delete_service{{$service->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">{{ trans('admin.delete_service') }}</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                        </div>
                                                                        <div class="modal-body">

                                                                            <p>{{ trans('admin.confirm_delete')}} {{ $service->name }}</p>
                                                                            @csrf

                                                                            <input type="hidden" value="{{$service->id}}" name="service_id">
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



                    <div class="d-flex justify-content-center align-items-center my-5">
                        {{ $services-> links() }}
                    </div>
				</div>