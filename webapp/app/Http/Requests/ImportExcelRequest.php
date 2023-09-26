<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportExcelRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'excel' => 'required|mimes:xls,xlsx',
        ];
    }
}
