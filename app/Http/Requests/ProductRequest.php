<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'desce' => 'required',
            'brand_id' => 'required',
            'path' => 'required',
            'sale' => 'required|integer',
            'tags' => 'required',
            'material' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên sản phẩm không được để trống',
            'name.max' => 'Tên sản phẩm không được quá 255 ký tự',
            'price.required' => 'Giá sản phẩm không được để trống',
            'price.integer' => 'Giá sản phẩm phải là số',
            'stock.required' => 'Số lượng sản phẩm không được để trống',
            'stock.integer' => 'Số lượng sản phẩm phải là số',
            'desce.required' => 'Mô tả sản phẩm không được để trống',
            'brand_id.required' => 'Thương hiệu sản phẩm không được để trống',
            'path.required' => 'Ảnh sản phẩm không được để trống',
            'sale.required' => 'Giảm giá sản phẩm không được để trống',
            'sale.integer' => 'Giảm giá sản phẩm phải là số',
            'tags.required' => 'Tags sản phẩm không được để trống',
            'material.required' => 'Chất liệu sản phẩm không được để trống',
        ];
    }
}
