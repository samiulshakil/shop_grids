<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        Gate::authorize('admin.products.create');
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'category_id'=>'required',
            'product_name'=>'required|unique:products',
            'product_code'=>'required',
            'product_qty'=>'required',
            'product_tags'=>'required',
            'product_color'=>'required',
            'product_thumbnail'=>'required',
            'image_one'=>'required',
            'image_two'=>'required',
            'image_three'=>'required',
            'selling_price'=>'required',
            'discount_price'=>'required',
            'short_description'=>'required',
            'long_description'=>'required',
            'key_features'=>'required',
            'specifications'=>'required',
        ];
    }
}
