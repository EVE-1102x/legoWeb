<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'ProName' => [
                'nullable',
                'string',
                'max:200'
            ],
            'ProPrice' => [
                'nullable',
                'integer'
            ],
            'ProImage' => [
                'nullable',
                'image'
            ],
            'ProDescription' => [
                'nullable',
                'string',
                'max:200'
            ],
            'ProStock' => [
                'nullable',
                'integer'
            ],
            'PiecesNumber' => [
                'nullable',
                'integer'
            ],
            'RequestPiecesNumber' => [
                'nullable',
                'integer'
            ],
            'CategoryID' => [
                'nullable',
                'integer'
            ]
        ];
    }
}
