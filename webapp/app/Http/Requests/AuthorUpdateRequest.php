<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|unique:authors,name,' . $this->route('author'),
        ];
    }
}
