<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FetchUsersRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'limit' => 'sometimes|required|integer|min:1|max:100'
        ];
    }
}
