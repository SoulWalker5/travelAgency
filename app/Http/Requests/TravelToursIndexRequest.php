<?php

namespace App\Http\Requests;

use App\Models\Tour;
use Illuminate\Foundation\Http\FormRequest;

class TravelToursIndexRequest extends FormRequest
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
            'sorting' => ['sometimes', 'in:asc,desc'],
            'sortingField' => ['sometimes', 'in:' . implode(Tour::SORTABLE_FIELDS)],
            'priceFrom' => ['sometimes', 'numeric', 'gt:0'],
            'priceTo' => ['sometimes', 'numeric', 'gt:0'],
            'dateFrom' => ['sometimes', 'date'],
            'dateTo' => ['sometimes', 'date'],
        ];
    }
}
