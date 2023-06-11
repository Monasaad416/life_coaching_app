@extends('layout.master')
@section('css')
@endsection
@section('page-header')
	<!-- breadcrumb -->		
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">{{ trans('admin.roles_list') }}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('admin.index')}}" class="default-color">{{ trans('admin.admin_dashboard') }}</a></li>
                    <li class="breadcrumb-item active">{{ trans('admin.roles_list') }}</li>
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
									<h4 class="card-title mg-b-0">{{trans('admin.roles_list')}}</h4>
                                    <button class="btn btn-primary"><a class="x-small text-white" href="{{route("admin.roles.create")}}">{{trans('admin.create_role')}}</a></button>
								</div>
								{{-- <p class="tx-12 tx-gray-500 mb-2">Example of Valex Hoverable Rows Table.. <a href="">Learn more</a></p> --}}
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-hover mb-0 text-md-nowrap">
										<thead>
											<tr>
                                                <th>#</th>
                                                <th>{{trans('admin.name')}}</th>
                                                <th width="280px">{{trans('admin.edit')}}</th>
                                                <th width="280px">{{trans('admin.delete')}}</th>

											</tr>
										</thead>
										<tbody>

                                            @foreach ($roles as $key => $role)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $role->name }}</td>

                                                <td>
                                                    <a href="{{route('admin.roles.edit',$role->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true" title="{{trans('admin.edit_role')}}"><i class="fa fa-edit text-white" aria-hidden="true"></i></a>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#role{{ $role->id }}" title="{{trans('admin.delete_role')}}"><i class="fa fa-trash"></i></button></td>
                                                    <!-- Delete Modal -->
                                                    <form action="{{route('admin.roles.destroy',$role)}}" method="POST">
                                                        <div class="modal fade" id="role{{$role->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">{{trans('admin.delete_role_from_list')}}</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>{{trans('admin.delete_confirm')}}  {{$role->name_ar}}</p>

                                                                        @csrf
                                                                        {{method_field('delete')}}
                                                                        <input type="hidden" value="{{$role->id}}" name="id">
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('admin.close')}}</button>
                                                                            <button type="submit" name="submit" class="btn btn-danger">{{trans('admin.delete')}}</button>
                                                                        </div>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </td>
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
				<div class="d-flex justify-content-center align-items-center">
					{{ $roles->links() }}
				</div>

				<!-- /row -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection




