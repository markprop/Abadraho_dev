<?php

namespace App\Http\Requests\Projects;

use Illuminate\Foundation\Http\FormRequest;

class ListingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'area' => 'string|nullable',
            'progress' => 'string|nullable',
            'type_id' => 'string|nullable',
            'builder' => 'string|nullable',
            'minDP' => 'string|nullable',
            'maxDP' => 'string|nullable',
            'minMI' => 'string|nullable',
            'maxMI' => 'string|nullable',
            'minPrice' => 'string|nullable',
            'maxPrice' => 'string|nullable',
            'maxBudget' => 'string|nullable',
            'tag_id' => 'string|nullable',
            'page' => 'string|nullable',
            'downPayment' => 'string|nullable',
            'reseller_id' => 'string|nullable',
            'monthInstall' => 'string|nullable',
            'yearlyInstall' => 'string|nullable',
            'halfYearlyInstall' => 'string|nullable',
            'quarterlyInstall' => 'string|nullable',
            'possession' => 'string|nullable',
            'calcSearch' => 'string|nullable',
        ];
    }
}
