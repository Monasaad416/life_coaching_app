@extends('layout.master')

@section('css')
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
              <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ trans('admin.delete_category') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('admin.categories') }} </span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xs-12">
                        <div class="col-md-12">
                        <br>
                        <form action="{{route('admin.category.destroy',$category)}}" method="POST">
                            <div tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <h5 class="modal-title" id="exampleModalLabel">{{ trans('admin.delete_category_from_list') }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>{{ trans('admin.confirm_delete') . $category->name}}</p>
                                        @csrf
                                        <input type="hidden" value="{{$category->id}}" name="id">
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('admin.close') }}</button>
                                            <button type="submit" name="submit" class="btn btn-danger">{{trans('admin.delete') }}</button>
                                        </div>
                                    </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection

