<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExcelUploadRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'file' => [
                'required', 'mimes:xls,xlsx,'
            ]
        ];
    }
}
