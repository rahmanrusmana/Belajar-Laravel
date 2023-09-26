<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'title' => 'required|unique:books|max:255',
            'author_id' => 'required|exists:authors,id',
            'amount' => 'required|integer|min:1',
            'cover' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
