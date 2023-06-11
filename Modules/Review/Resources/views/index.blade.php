@extends('layout.master')

@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ trans('admin.reviews') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/{{ trans('admin.reviews_list') }}</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
				<!-- row opened -->

                @livewire('review.search-review-component')

				<!-- /row -->

				</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')

@endsection
