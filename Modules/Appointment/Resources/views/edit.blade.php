@extends('layout.master')

@section('css')
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">{{trans('admin.edit_appointment')}}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('coach.appointment.index')}}" class="default-color">{{ trans('admin.appointments') }} </a></li>
                    <li class="breadcrumb-item active">{{ trans('admin.edit_appointment') }}</li>
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

                            @include('inc.errors')
                            {!! Form::model($appointment,[
                                'route' => 'coach.appointment.update',
                                ])
                            !!}

                            {!!Form::hidden('id', $appointment->id)!!}

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        {!!Form::label('select_day', trans('admin.select_day'))!!}
                                        {!! Form::select('day' , [
                                            'Friday' => trans('admin.Friday'),
                                            'Saturday' => trans('admin.Saturday'),
                                            'Sunday' => trans('admin.Sunday'),
                                            'Monday' => trans('admin.Monday'),
                                            'Tuesday' => trans('admin.Tuesday'),
                                            'Wednesday' => trans('admin.Wednesday'),
                                            'Thursday' => trans('admin.Thursday'),
                                        ], $appointment->day, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="col-4">
                                        {!!Form::label('from', trans('admin.from'))!!}
                                        {!!Form::time('from', $appointment->from,[
                                            'class' => 'form-control  mt-1 mb-3',
                                            'placeholder' => trans('admin.write_from')
                                        ])!!}
                                    </div>
                                    <div class="col-4">
                                        {!!Form::label('to', trans('admin.to'))!!}
                                        {!!Form::time('to', $appointment->to,[
                                            'class' => 'form-control  mt-1 mb-3',
                                            'placeholder' => trans('admin.write_to')
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
@endsection

