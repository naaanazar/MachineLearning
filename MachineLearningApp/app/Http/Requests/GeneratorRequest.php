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
            'rows' => sprintf(
                'bail|required|integer|min:1|max:%d', 
                \App\Library\Generators\DatasetGenerator::MAX_ROWS_COUNT
            ),
        ];
    }

    public function messages()
    {
        return [
            'rows.required' => 'This field is required',
            'rows.integer' => 'Value must be a number',
            'rows.min' => 'Value must be positive number',
            'rows.max' => sprintf(
                'Value cannot be higher than %d',
                \App\Library\Generators\DatasetGenerator::MAX_ROWS_COUNT
            ),
        ];
    }
}
