@extends('layout.master')
@section('css')

@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{trans('admin.profile')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="" class="default-color">{{trans('admin.home')}}</a></li>
                <li class="breadcrumb-item active">{{trans('admin.update_profile')}}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <style>
                    .main-body {
                        padding: 15px;
                    }
                    .card {
                        box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
                    }

                    .card {
                        position: relative;
                        display: flex;
                        flex-direction: column;
                        min-width: 0;
                        word-wrap: break-word;
                        background-color: #fff;
                        background-clip: border-box;
                        border: 0 solid rgba(0,0,0,.125);
                        border-radius: .25rem;
                    }

                    .card-body {
                        flex: 1 1 auto;
                        min-height: 1px;
                        padding: 1rem;
                    }

                    .gutters-sm {
                        margin-right: -8px;
                        margin-left: -8px;
                    }

                    .gutters-sm>.col, .gutters-sm>[class*=col-] {
                        padding-right: 8px;
                        padding-left: 8px;
                    }
                    .mb-3, .my-3 {
                        margin-bottom: 1rem!important;
                    }

                    .bg-gray-300 {
                        background-color: #e2e8f0;
                    }
                    .h-100 {
                        height: 100%!important;
                    }
                    .shadow-none {
                        box-shadow: none!important;
                    }
                </style>

                <div class="container">
                    <div class="main-body">
                        <div class="row">
                            <div class="col">
                              <div class="card mb-3">
                                <div class="card-body">
                                    <form action="{{route('coach.add_certificate',auth('coach')->user()->id)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                         {{-- {{ method_field('patch') }} --}}
                                         <input type="hidden" name="id" value="{{auth('coach')->user()->id}}">

                                        <div class="row">
                                            <div class="col-2">
                                                <p class="mb-0">{{trans('admin.certificates')}}</p>
                                            </div>
                                            <div class="col-8">
                                                <p class="text-muted mb-0">
                                                    <div class="custom-file">
                                                        <input type="file" id="certificate" class="custom-file-input" name="certificates[]"  accept="image/*" multiple>
                                                        <label class="custom-file-label" for="certificate">{{ trans('admin.choose_images') }}</label>
                                                    </div>
                                                </p><br><br>

                                            </div>
                                            <div class="col-2">
                                                <button type="submit" class="btn btn-secondary">{{trans('admin.add_certificate')}}</button>
                                            </div>
                                        </div>  
                                    </form>
                                    <hr>
                                </div>
                              </div>
                            </div>
                        </div>
                        <hr>
                        <div>
                            @foreach ($certificates as $image )
                                <div class="row">
                                    <div class="col-8">
                                        <img src="{{asset('uploads/coaches_certificate') ."/" .$image->image}}" width = "100" class="my-3">
                                    </div>
                                    <div class="col-4">
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_image{{ $image->id }}" title="{{ trans('admin.delete') }}"><i class="fa fa-trash"></i></button></td>
                                        <!-- Delete Modal -->
                                        <form action="{{route('coach.delete_certificate',$image)}}" method="POST">
                                            <div class="modal fade" id="delete_image{{$image->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">{{ trans('admin.delete_certificate') }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>{{ trans('admin.delete_certificate_sure') }}{{$image->name_ar}}</p>

                                                            @csrf
                                                            {{-- {{method_field('delete')}} --}}
                                                            <input type="hidden" value="{{$image->id}}" name="certificate_id">
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('admin.close') }}</button>
                                                                <button type="submit" name="submit" class="btn btn-danger">{{ trans('admin.delete') }}</button>
                                                            </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <hr>



                                <br>
                            @endforeach
                        </div>

                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
    <script>
        function show_password()
        {
            let password = document.getElementById('password');
            if (password.type === "password"){
                password.type = "text";
                //console.log(password.type )
            } else {
                password.type = "password";
            }
        }
    </script>
@endsection
