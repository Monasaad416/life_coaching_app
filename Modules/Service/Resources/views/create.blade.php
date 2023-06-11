@extends('layout.master')

@section('css')
@endsection

@section('page-header')
    <!-- breadcrumb -->

    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">{{ trans('admin.services_list') }}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('coach.service.index')}}" class="default-color">{{ trans('admin.services_list') }}</a></li>
                    <li class="breadcrumb-item active">{{ trans('admin.create_service') }}</li>
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

                        @inject('model', 'Modules\Service\Entities\Service')
                        @php
                            $categories = Modules\Category\Entities\Category::pluck('name_ar', 'id');
                        @endphp


                        @include('inc.errors')
                        {!! Form::model($model,[
                            'route' => 'coach.service.store',

                            ])
                        !!}

                            <div class="card-body">
                                <div class="row">
                                    <div class="col form-group">
                                        {!!Form::label('name_ar', trans('admin.service_arabic'))!!}
                                        {!!Form::text('name_ar', null,[
                                            'class' => 'form-control  mt-1 mb-3',
                                            'placeholder' => trans('admin.service_arabic')
                                        ])!!}
                                    </div>

                                    <div class="col form-group">
                                        {!!Form::label('name_en', trans('admin.service_english'))!!}
                                        {!!Form::text('name_en', null,[
                                            'class' => 'form-control  mt-1 mb-3',
                                            'placeholder' => trans('admin.service_english')
                                        ])!!}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col form-group">
                                        {!!Form::label('description_ar', trans('admin.description_arabic'))!!}
                                        {!!Form::textarea('description_ar', null,[
                                            'class' => 'form-control  mt-1 mb-3',
                                            'placeholder' => trans('admin.description_arabic')
                                        ])!!}
                                    </div>

                                    <div class="col form-group">
                                        {!!Form::label('description_en', trans('admin.description_english'))!!}
                                        {!!Form::textarea('description_en', null,[
                                            'class' => 'form-control  mt-1 mb-3',
                                            'placeholder' => trans('admin.description_english')
                                        ])!!}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col form-group">
                                        {!!Form::label('category_id', trans('admin.select_category'))!!}
                                        {!! Form::select('category_id', $categories, null ,[
                                            'class' => 'form-control  mt-1 mb-3',
                                            'placeholder' => trans('admin.select_category'),
                                        ])
                                        !!}
                                    </div>
                                    <div class="col form-group">
                                        {!!Form::label('type', trans('admin.select_type'))!!}
                                        {!! Form::select('type', ['service' => trans('admin.service')  ,  'product' => trans('admin.product')], 'service' ,[
                                            'class' => 'form-control',
                                            'id' => 'type',

                                        ])!!}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col form-group">
                                        {!!Form::label('price', trans('admin.price'))!!}
                                        {!! Form::number('price',null,[
                                            'min' => 0,
                                            'class' => 'form-control',
                                            'id' => 'price',
                                            'step' => 'any',
                                        ])!!}
                                    </div>

                                    <div class="col form-group">
                                        {!!Form::label('discount_price', trans('admin.discount_price'))!!}
                                        {!! Form::number('discount_price',null,[
                                            'min' => 0,
                                            'class' => 'form-control',
                                            'id' => 'discount_price',
                                            'step' => 'any',
                                        ])!!}
                                    </div>
                                    
                                    
                                    <div class="col form-group" id='shipping_price'>
                                        {!!Form::label('shipping_price', trans('admin.shipping_price'))!!}
                                        {!! Form::number('shipping_price',null,[
                                            'min' => 0,
                                            'class' => 'form-control',
                                            'step' => 'any',
                                           
                                        ])!!}
                                    </div>

                                    <div class="col form-group" id='duration'>
                                        {!!Form::label('duration', trans('admin.duration'))!!}
                                        {!! Form::number('duration',null,[
                                            'min' => 0,
                                            'class' => 'form-control',
                                            
                                        ])!!}
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

    <script>
    $(document).ready(function () {
            $('#shipping_price').hide();
            $('select[name="type"]').on('change', function () {
                var type = $(this).val();
                console.log(type);
                if (type == 'service') {
                    $('#shipping_price').hide();
                    $('#duration').show();
                } else {
                    $('#shipping_price').show();
                    $('#duration').hide();

                }
            });
        });
    </script>

@endsection

