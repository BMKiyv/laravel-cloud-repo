<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\isValidExistsRule;

class UploadFileRequest extends FormRequest
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
            
            'isexists'=>['required',new isValidExistsRule],
            'file' => 'required|mimes:pdf,xlx,doc,docx,xls|max:20000',
                ];
    }
    public function messages() {
        return [
            'isexists.required'=> 'fucking error!!!!!!!!!!!'
        ];
    }
}