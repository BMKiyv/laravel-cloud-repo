<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStdRequest extends FormRequest
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
            'email' => 'required',
            'password' => 'required',
            'subject' => 'min:3|max:30'
                ];
    }
    public function messages() {
        return [
            'email.required' => 'Поле електронна пошта є обов\'язковим',
            'password.required' => 'Поле пароль є обов\'язковим',
            'subject.min' => 'Мінімальна кількість символів - 3'
            
        ];
    }
}