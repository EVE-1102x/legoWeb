<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LegoPieceFormRequest extends FormRequest
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
            'PName' => [
                'required',
                'string',
                'max:200'
            ],
            'PImage' => [
                'nullable',
                'image'
            ],
            'ShapeID' => [
                'required',
                'integer'
            ],
            'ColorID' => [
                'required',
                'integer'
            ],
            'SizeID' => [
                'required',
                'integer'
            ],
            'InStock' => [
                'required',
                'integer'
            ],
        ];
    }
}
