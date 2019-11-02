<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminRequest extends FormRequest
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
          'name' => ['required', 'string', 'max:50'],
          'email' => ['required', 'string', 'email'],
          'password' => ['required', 'string', 'min:1', 'confirmed'],
          'role' => ['required'],
          'status' => ['required'],
        ];
    }

    // custom error message
    public function messages()
     {
        return [
          'name.required' => 'กรุณากรอกข้อมูล ชื่อ-นามสกุล',
          'email.required' => 'กรุณากรอกข้อมูล Email',
          'password.required' => 'กรุณากรอกข้อมูล รหัสผ่าน',
          'role.required' => 'กรุณาเลือกประเภท',
          'status.required' => 'กรุณาเลือกสถานะ',
          'confirmed' => 'รหัสผ่านไม่ตรงกัน',
          'max' => 'จำนวนตัวอักษรเกิน 50 ตัว',
          'min' => 'จำนวนตัวอักษรอย่างน้อย 1 ตัว'
        ];
     }
}
