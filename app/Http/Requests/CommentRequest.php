<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'comment'        => 'required|string|max:300|min:2',
            
        ];
    }


    public function messages()
    {
        return [
            'required' => 'you should write comment',
            'max'      => 'you should write less than 300 characters',
            'min'      => 'you should write more than 2 characters',
        ];
    }
}
