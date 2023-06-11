@extends('layout.master')
@section('css')
@endsection
@section('page-header')
	<!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">{{ trans('admin.service_details') }}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    @if(auth('admin')->check())
                        <li class="breadcrumb-item"><a href="{{route('admin.index')}}" class="default-color">{{ trans('admin.admin_dashboard') }}</a></li>
                    @elseif(auth('coach')->check())
                        <li class="breadcrumb-item"><a href="{{route('admin.index')}}" class="default-color">{{ trans('admin.coach_dashboard') }}</a></li>
                    @endif
                    <li class="breadcrumb-item active">{{ trans('admin.service_details') }}</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    <!-- row -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0 text-md-nowrap">
                                <thead>
                                    <tr>
                                        <th>{{trans('admin.item')}}</th>
                                        <th>{{trans('admin.details')}} </th>

                                    </tr>
                                </thead>
                                <tbody>

                                        <tr>
                                            <td>{{trans('admin.service_name')}}</td>
                                            <td>{{ $service->name }}</td>
                                        </tr>

                                            <td>{{trans('admin.service_desc')}}</td>
                                            <td>{{ $service->description}}</td>
                                        </tr>

                                        </tr>
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
                                            <td>{{trans('admin.type')}}</td>
                                            <td>{{ $type }}</td>
                                        </tr>
                      

                                            <tr>
                                                <td>{{trans('admin.coach')}}</td>
                                                <td>{{ $service->coach->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>{{trans('admin.category')}}</td>
                                                <td>{{ $service->category->name}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{trans('admin.price')}}</td>
                                                <td>{{ $service->price }}</td>
                                            </tr>
                                            <tr>
                                                <td>{{trans('admin.discount_price')}}</td>
                                                <td>
                                                    @if ($service->disccount_price)
                                                        {{ $service->disccount_price }}
                                                    @else
                                                        <p> {{trans('admin.not_found')}}</p>
                                                    @endif
                                                </td>
                                            </tr>


                                            <tr>
                                                <td>{{trans('admin.shipping_price')}}</td>
                                                <td>
                                                   @if ($service->shipping_price)
                                                        {{ $service->shipping_price }}
                                                    @else
                                                        <p> {{trans('admin.not_found')}}</p>
                                                    @endif
                                                </td>
                                            </tr>

                                      

                                            <tr>
                                                <td>{{trans('admin.duration')}}</td>
                                                <td>{{ $service->duration }}</td>
                                            </tr>
                               

             
      

                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>


            
        </div>
    </div>
    <!-- /row -->


        </div>
        <!-- Container closed -->
    </div>
		<!-- main-content closed -->
@endsection
@section('js')
@endsection
