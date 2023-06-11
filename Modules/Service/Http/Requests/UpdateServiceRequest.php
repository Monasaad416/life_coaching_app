<?php

namespace Modules\Service\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name_en' => 'string|max:255',
            'name_ar' => 'string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'price' => 'numeric',
            'discount_price' => 'nullable|numeric',
            'shipping_price' => 'required_if:duration,=,null',
            'duration' => 'required_if:shipping_price,=,null',
        ];
    }

    public function messages()
    {
        return [
            'name_en.string' => trans('validation.name_en_string'),
            'name_en.max' => trans('validation.max'),
            'name_ar.string' => trans('validation.name_ar_string'),
            'name_ar.max' => trans('validation.max'),
            'price.numeric' => trans('validation.price_numeric'),
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
