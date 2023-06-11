@extends('layout.master')

@section('css')
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
              <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ trans('admin.edit_category') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('admin.categories') }} </span>
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
                        @php
                            $categories = Modules\Category\Entities\Category::pluck('name_'.LaravelLocalization::getCurrentLocale() , 'id')
                        @endphp


                        @include('inc.errors')
                        {!! Form::model($category,[
                            'route' => ['admin.category.update',$category->id],

                            ])
                        !!}

                            {!!Form::hidden('id', $category->id)!!}

                            <div class="card-body">
                                <div class="form-group">
                                    {!!Form::label('name_ar', trans('admin.category_arabic')) !!}
                                    {!!Form::text('name_ar', $category->name_ar,[
                                        'class' => 'form-control  mt-1 mb-3',
                                        'placeholder' => trans('admin.category_arabic')
                                    ])!!}
                                </div>

                                <div class="form-group">
                                    {!!Form::label('name_en', trans('admin.category_english')) !!}
                                    {!!Form::text('name_en', $category->name_en,[
                                        'class' => 'form-control  mt-1 mb-3',
                                        'placeholder' => trans('admin.category_english')
                                    ])!!}
                                </div>

                                <div class="form-group">
                                    {!!Form::label('parent_id', trans('admin.parent_category')) !!}
                                    {!! Form::select('parent_id', $categories, $category->parent ? $category->parent->id : null ,
                                    [
                                    'class' => 'form-control  mt-1 mb-3',
                                    'placeholder' => trans('admin.select_category'),
                                    ])
                                    !!}
                                </div>



                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    {!!Form::submit(trans('admin.edit'),[
                                        'class' =>'btn btn-secondary btn-flat'
                                    ])!!}
                                </div>
                            </div>
                        {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection

