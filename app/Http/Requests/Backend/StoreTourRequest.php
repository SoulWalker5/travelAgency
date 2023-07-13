<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class StoreTourRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'travelId' => [
                'required',
                'exists:travels,id',
            ],
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'startingDate' => [
                'required',
                'date',
            ],
            'endingDate' => [
                'required',
                'date',
            ],
            'price' => [
                'required',
                'numeric',
            ],
        ];
    }
}