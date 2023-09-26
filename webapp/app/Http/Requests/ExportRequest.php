<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExportRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'author_id' => 'required',
            'type' => 'required|in:pdf,xls',
        ];
    }

    public function messages()
    {
        return [
            'author_id.required' => 'Anda Belum Memilih Penulis, Pilih Lah Minimal 1',
        ];
    }
}
