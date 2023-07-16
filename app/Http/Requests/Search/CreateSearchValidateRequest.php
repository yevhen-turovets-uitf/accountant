<?php

namespace App\Http\Requests\Search;

use Illuminate\Foundation\Http\FormRequest;

class CreateSearchValidateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'search' => 'required|string|min:3|max:400'
        ];
    }
}
