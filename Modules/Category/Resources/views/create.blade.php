@extends('layout.master')

@section('css')
@endsection

@section('page-header')
    <!-- breadcrumb -->
     <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">{{ trans('admin.create_category') }}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('admin.category.index')}}" class="default-color">{{ trans('admin.categories_list') }}</a></li>
                    <li class="breadcrumb-item active">{{ trans('admin.create_category') }}</li>
                </ol>
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

                        @inject('model', 'Modules\Category\Entities\Category')
                        @php
                            $categories = Modules\Category\Entities\Category::pluck('name_'.LaravelLocalization::getCurrentLocale(), 'id');
                        @endphp


                        @include('inc.errors')
                        {!! Form::model($model,[
                            'route' => 'admin.category.store',

                            ])
                        !!}

                            <div class="card-body">
                                <div class="form-group">
                                    {!!Form::label('name_ar', trans('admin.category_arabic')) !!}
                                    {!!Form::text('name_ar', null,[
                                        'class' => 'form-control  mt-1 mb-3',
                                        'placeholder' => trans('admin.category_arabic')
                                    ])!!}
                                </div>

                                <div class="form-group">
                                    {!!Form::label('name_en', trans('admin.category_english')) !!}
                                    {!!Form::text('name_en', null,[
                                        'class' => 'form-control  mt-1 mb-3',
                                        'placeholder' => trans('admin.category_english')
                                    ])!!}
                                </div>

                                <div class="form-group">
                                    {!!Form::label('parent_id', trans('admin.parent_category')) !!}
                                    {!! Form::select('parent_id', $categories, null ,
                                    [
                                    'class' => 'form-control  mt-1 mb-3',
                                    'placeholder' => trans('admin.select_category'),
                                    ])
                                    !!}
                                </div>



                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    {!!Form::submit(trans('admin.save'),[
                                        'class' =>'btn btn-primary btn-flat'
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

