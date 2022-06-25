<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_title' => 'required',
            'product_barcode' => 'required',
            'category_id' => 'required',
            'company_id' => 'required',
            'retail_price' => 'required|digits',
            'product_feature_img' => 'mimes:jpg,png|max:2048'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'product_title.required' => 'Product title is required',
            'product_barcode.required' => 'Product barcode is required',
            'category_id.required' => 'Please select a category',
            'company_id.required' => 'Please select a company',
            'retail_price.required' => 'Retail Price is required',
            'product_feature_img.required' => 'Please select a company',
        ];
    }
}
