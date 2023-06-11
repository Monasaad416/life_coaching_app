<?php

namespace Modules\Appointment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAppointmentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'day' => 'required|string',
            'from' => 'required|date_format:H:i',
            'to' => 'required|date_format:H:i|after:start_time',
        ];
    }

    public function messages()
    {
        return [
            'day.required' => trans('validation.day_required'),
            'day.string' => trans('validation.day_string'),
            'from.required' => trans('validation.from_required'),
            'from.date_format' => trans('validation.date_format'),
            'to.required' => trans('validation.to_requird'),
            'to.date_format' => trans('validation.date_format'),
        ];
    }
}
