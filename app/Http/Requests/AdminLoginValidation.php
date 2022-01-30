<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminLoginValidation extends FormRequest
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
            'email'=>'required|email',
            'password'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'email.required'=>'يجب إدخال البريد الإلكتروني',
            'email.email'=>'يجب إدخال البريد الإلكتروني بطريقة صحيحة',
            'password.required'=>'يجب إدخال كلمة المرور'
                     
        ];
    }
}
