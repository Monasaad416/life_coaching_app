
<div class="row row-sm">
    <!--div-->
    @include('inc.messages')
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">{{trans('admin.reviews')}}</h4>
                    @can('create_review')
                        <button class="btn btn-primary"><a class="x-small text-white" href="{{route("admin.review.create")}}">{{trans('admin.create_review')}}</a></button>
                    @endcan
                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                        <!-- Search for reviews -->
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
                        
                        <div class="row">
                            
                            @if(auth('admin')->check())
                            <div class="col my-3">
                                <label class="text-muted" for="search_by_coach" >{{trans('admin.search_by_coach')}}</label>
                                <input type="text"  class="form-control search" wire:model="search_by_coach" placeholder="{{trans('admin.search_by_coach')}}">
                            </div>
                            @endif
                            <div class="col my-3">
                                <label class="text-muted" for="search_by_service" >{{trans('admin.search_by_service')}}</label>
                                <input type="text" class="form-control search" wire:model="search_by_service" placeholder="{{trans('admin.search_by_service')}}">
                            </div>
                            <div class="col my-3">
                                <label class="text-muted" for="search_by_rating" >{{trans('admin.search_by_rating')}}</label>
                                <select  class="form-control search" wire:model="search_by_rating" placeholder="{{trans('admin.search_by_review')}}">
                                    <option value="0">{{trans('admin.select_rating')}}</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        

                        </div>
                            
                        
                    <table class="table table-hover mb-0 text-md-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{trans('admin.comment')}}</th>
                                <th>{{trans('admin.rating')}}</th>
                                @if(auth('admin')->check())
                                    <th>{{trans('admin.coach')}}</th> 
                                @endif                                            
                                <th>{{trans('admin.service')}}</th>
                                <th>{{trans('admin.client')}}</th>
                                @can('delete_review')
                                <th>{{trans('admin.delete')}}</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody id="filtered-results">
                            @foreach ($reviews as $review )
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $review->comment}}</td>
                                    <td>{{ $review->rating}}</td>

                                    @if(auth('admin')->check())
                                        <td>{{ $review->coach ? $review->coach->name : '---'}}</td>
                                    @endif
                                    <td>{{ $review->service ? $review->service->name : '---'}}</td>
                                    <td>{{ $review->client->name }}</td>

                                    @can('delete_review') 
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_review{{ $review->id }}" title="{{trans('admin.delete_review')}}"><i class="fa fa-trash"></i></button></td>
                                            <!-- Delete Modal -->
                                            <form action="{{route('admin.review.destroy',$review)}}" method="POST">
                                                <div class="modal fade" id="delete_review{{$review->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">{{ trans('admin.delete_review_from_list') }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>{{ trans('admin.confirm_delete') . $review->comment}}</p>

                                                                @csrf
                                                                {{-- {{method_field('delete')}} --}}
                                                                <input type="hidden" value="{{$review->id}}" name="id">
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
            {{ $reviews-> links() }}
        </div>
</div>
<!-- /row -->


			
		