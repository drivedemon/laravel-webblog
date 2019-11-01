<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAdminRequest extends FormRequest
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
          'name' => ['required', 'string', 'max:100'],
          'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
          'password' => ['required', 'string', 'min:1', 'confirmed'],
        ];
    }

    // custom error message
    public function messages()
     {
        return [
          'name.required' => 'กรุณากรอกข้อมูล ชื่อ-นามสกุล',
          'email.required' => 'กรุณากรอกข้อมูล Email',
          'password.required' => 'กรุณากรอกข้อมูล รหัสผ่าน',
          'unique' => 'ห้ามกรอกข้อมูลซ้ำ',
          'confirmed' => 'รหัสผ่านไม่ตรงกัน',
          'max' => 'จำนวนตัวอักษรเกิน 50 ตัว',
          'min' => 'จำนวนตัวอักษรอย่างน้อย 1 ตัว'
        ];
     }
}
