<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCommentRequest extends FormRequest
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
          'comment' => 'required|min:1|max:500'
        ];
    }

    // custom error message
    public function messages()
     {
        return [
          'required' => 'กรุณากรอกข้อมูล',
          'min' => 'กรุณากรอกตัวอักษรอย่างน้อย 1 ตัว'
          'max' => 'ความยาวตัวอักษรเกิน 500 ตัว'
        ];
     }
}
