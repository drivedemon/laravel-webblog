<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
          'name' => 'required|max:50',
          'email' => 'required',
          'role' => 'required',
          'status' => 'required',
        ];
    }

    // custom error message
    public function messages()
     {
        return [
          'name.required' => 'กรุณากรอกข้อมูล ชื่อ',
          'email.required' => 'กรุณากรอกข้อมูล Email',
          'role.required' => 'กรุณาเลือกประเภท',
          'status.required' => 'กรุณาเลือกสถานะ',
          'max' => 'จำนวนตัวอักษรเกิน 50 ตัว'
        ];
     }
}
