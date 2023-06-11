<?php

namespace Modules\Service\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name_en' => 'required|string|max:255|unique:services,name_en',
            'name_ar' => 'required|string|max:255|unique:services,name_ar',
            'description_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'discount_price' => 'nullable|numeric',
            'shipping_price' => 'required_if:duration,=,null',
            'duration' => 'required_if:shipping_price,=,null',
        ];
    }

    public function messages()
    {
        return [
            'name_en.required' => trans('validation.name_en_required'),
            'name_en.string' => trans('validation.name_en_string'),
            'name_en.max' => trans('validation.max'),
            'name_ar.required' => trans('validation.name_ar_required'),
            'name_ar.string' => trans('validation.name_ar_string'),
            'name_ar.max' => trans('validation.max'),
            'name_ar.unique' => trans('validation.unique'),
            'name_en.unique' => trans('validation.unique'),

            'description_en.required' => trans('validation.description_en_required'),
            'description_en.string' => trans('validation.description_en_string'),
            'description_ar.required' => trans('validation.description_ar_required'),
            'description_ar.string' => trans('validation.description_ar_string'),

            'price.numeric' => trans('validation.price_numeric'),
            'price.required' => trans('validation.price_required'),
            'discount_price.numeric' => trans('validation.discount_price_numeric'),
            'shipping_price.numeric' => trans('validation.shipping_price_numeric'),
            'duration.numeric' => trans('validation.duration_numeric'),
        ];
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
