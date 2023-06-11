				<!-- row opened -->
				<div class="row row-sm">
					<!--div-->

                    @include('inc.messages')
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">{{trans('admin.categories')}}</h4>
									@can('create_category')
                                        <button class="btn btn-primary"><a class="x-small text-white" href="{{route("admin.category.create")}}">{{trans('admin.create_category')}}</a></button>
									@endcan
								</div>

							</div>
							<div class="card-body">
								<div class="table-responsive">
                                        <!-- Search for categories -->
                                        <style>
                                            .search {
                                                background-color : #edf0f9;
                                            }


                                            input[type="search"] {
                                                background-image: url('{{asset('assets/img/searcg_icon.svg')}}');
                                                background-position: right center;
                                                background-repeat: no-repeat;
                                                padding-right: 25px; /* Adjust this value to position the icon */
                                            }
                                        </style>
                                        <input type="text" class="form-control my-4 search" wire:model="search_by_category" placeholder="{{trans('admin.search_by_category')}}">

									<table class="table table-hover mb-0 text-md-nowrap">
										<thead>
											<tr>
												<th>#</th>
												<th>{{trans('admin.category')}}</th>
                                                <th>{{trans('admin.parent_category')}}</th>
												@can('edit_category')
                                                <th>{{trans('admin.edit')}}</th>
												@endcan
												@can('delete_category')
                                                <th>{{trans('admin.delete')}}</th>
												@endcan
											</tr>
										</thead>
										<tbody id="filtered-results">
                                            @foreach ($categories as $category )
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $category->name}}</td>

                                                    <td>{{ $category->parent ? $category->parent->name : '---'}}</td>
                                                    {{-- <td>{{ $category->specialist->name_ar }}</td> --}}
													@can('edit_category')
                                                        <td>
                                                            <a href="{{route('admin.category.edit',$category->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true" title="{{ trans('admin.edit_category') }}"><i class="fa fa-edit text-white" aria-hidden="true"></i></a>
                                                        </td>
													@endcan

                                                    @can('delete_category') 
                                                        <td>
                                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_category{{ $category->id }}" title="{{ trans('admin.delete_category') }}"><i class="fa fa-trash"></i></button></td>
                                                            <!-- Delete Modal -->
                                                            <form action="{{route('admin.category.destroy',$category)}}" method="POST">
                                                                <div class="modal fade" id="delete_category{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">{{ trans('admin.delete_category_from_list') }}</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p>{{ trans('admin.confirm_delete') . $category->name}}</p>

                                                                                @csrf
                                                                                {{-- {{method_field('delete')}} --}}
                                                                                <input type="hidden" value="{{$category->id}}" name="id">
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('admin.close') }}</button>
                                                                                    <button type="submit" name="submit" class="btn btn-danger">{{trans('admin.delete') }}</button>
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
                        {{ $categories-> links() }}
                    </div>
				</div>
				<!-- /row -->


		