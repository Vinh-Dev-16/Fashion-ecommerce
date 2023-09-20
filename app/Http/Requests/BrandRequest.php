<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
    public function rules()
    {
        return [

                    'name' => 'required|unique:brands,name',
                    'slug' => 'required|unique:brands,slug',
                    'logo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                    'description' => 'required',
            ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên thương hiệu không được để trống',
            'name.unique' => 'Tên thương hiệu đã tồn tại',
            'slug.required' => 'Slug không được để trống',
            'slug.unique' => 'Slug đã tồn tại',
            'logo.required' => 'Logo không được để trống',
            'logo.image' => 'Logo phải là ảnh',
            'logo.mimes' => 'Logo phải có định dạng jpg,png,jpeg,gif,svg',
            'logo.max' => 'Logo phải có dung lượng nhỏ hơn 2048',
            'description.required' => 'Mô tả không được để trống',
        ];
    }
}
