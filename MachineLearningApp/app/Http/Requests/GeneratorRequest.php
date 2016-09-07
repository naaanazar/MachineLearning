<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class GeneratorRequest extends Request
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
            'rows' => 'required|integer|min:0',
        ];
    }

    public function messages()
    {
        return [
            'rows.required' => 'Records quantity is required',
            'rows.integer'  => 'Records quantity must be an integer',
            'rows.min'  => 'Records quantity must be positive number',
        ];
    }
}
