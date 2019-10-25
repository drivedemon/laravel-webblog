<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
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
          'title' => 'required|unique:posts',
          'description' => 'required|max:100',
          'content' => 'required',
        ];
    }

    // custom error message
    public function messages()
     {
        return [
          'required' => 'กรุณากรอกข้อมูล',
          'unique' => 'ห้ามกรอกข้อมูลซ้ำ',
          'max' => 'จำนวนตัวอักษรเกิน 100 ตัว'
        ];
     }
}
