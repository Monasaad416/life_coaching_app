@extends('layout.master')

@section('css')
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ trans('admin.edit_service') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('admin.services') }} </span>
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
                            $categories = Modules\Category\Entities\Category::pluck('name_'.LaravelLocalization::getCurrentLocale().' as name', 'id');
                        @endphp


                        @include('inc.errors')
                        {!! Form::model($service,[
                            'route' => ['coach.service.update',$service->id],

                            ])
                        !!}

                            <div class="card-body">
                                {!!Form::hidden('service_id', $service->id)!!}
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
                                        {!! Form::select('category_id', $categories, $service->category->id ,[
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
                                        {!! Form::number('price',$service->price,[
                                            'min' => 0,
                                            'class' => 'form-control',
                                            'id' => 'price',
                                            'step' => 'any',
                                        ])!!}
                                    </div>

                                    <div class="col form-group">
                                        {!!Form::label('discount_price', trans('admin.discount_price'))!!}
                                        {!! Form::number('discount_price',$service->discount_price,[
                                            'min' => 0,
                                            'class' => 'form-control',
                                            'id' => 'discount_price',
                                            'step' => 'any',
                                        ])!!}
                                    </div>
                                    
                                    
                                    <div class="col form-group" id='shipping_price'>
                                        {!!Form::label('shipping_price', trans('admin.shipping_price'))!!}
                                        {!! Form::number('shipping_price',$service->shipping_price,[
                                            'min' => 0,
                                            'class' => 'form-control',
                                            'step' => 'any',
                                            'id' => 'shipping_price_inpit'
                                           
                                        ])!!}
                                    </div>

                                    <div class="col form-group" id='duration'>
                                        {!!Form::label('duration', trans('admin.duration'))!!}
                                        {!! Form::number('duration',$service->duration,[
                                            'min' => 0,
                                            'class' => 'form-control',
                                            'id' => 'duration_input',
                                            
                                        ])!!}
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

    <script>
    $(document).ready(function () {
        if($('#shipping_price_input').val(0) ){
            $('#duration').hide();
            $('#shipping_price').show();
        } else {
            $('#duration').show();
            $('#shipping_price').hide();
        }
            
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

