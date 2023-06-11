use Modules\Service\Entities\Service;
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
                    @if(auth('admin')->check())
                        <li class="breadcrumb-item"><a href="{{route('admin.index')}}" class="default-color">{{ trans('admin.admin_dashboard') }}</a></li>
                    @elseif(auth('coach')->check())
                        <li class="breadcrumb-item"><a href="{{route('admin.index')}}" class="default-color">{{ trans('admin.coach_dashboard') }}</a></li>
                    @endif
                    <li class="breadcrumb-item active">{{ trans('admin.services_list') }}</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
				<!-- row opened -->

		        @livewire('service.search-service-component')
                
				<!-- /row -->


			
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
@endsection
