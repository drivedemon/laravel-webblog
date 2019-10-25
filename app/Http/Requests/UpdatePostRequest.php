<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
          'title' => 'required',
          'description' => 'required|max:50',
          'content' => 'required',
          'category' => 'required'
        ];
    }

    // custom error message
    public function messages()
     {
        return [
          'title.required' => 'กรุณากรอกข้อมูล ชื่อบทความ',
          'description.required' => 'กรุณากรอกข้อมูล คำอธิบาย',
          'content.required' => 'กรุณากรอกข้อมูล เนื้อหา',
          'unique' => 'ห้ามกรอกข้อมูลซ้ำ',
          'max' => 'จำนวนตัวอักษรเกิน 50 ตัว'
        ];
     }
}
