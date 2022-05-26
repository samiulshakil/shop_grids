<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        Gate::authorize('admin.products.edit');
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $name = $this->request->get('product_name');
        return [
            'category_id'=>'required',
            'product_name'=>['required', Rule::unique('products')->ignore($name,'product_name')],
            'product_code'=>'required',
            'product_qty'=>'required',
            'product_tags'=>'required',
            'product_color'=>'required',
            'product_thumbnail'=>'nullable',
            'image_one'=>'nullable',
            'image_two'=>'nullable',
            'image_three'=>'nullable',
            'selling_price'=>'required',
            'discount_price'=>'required',
            'short_description'=>'required',
            'long_description'=>'required',
            'key_features'=>'required',
            'specifications'=>'required',
        ];
    }
}
