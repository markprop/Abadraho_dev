<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'name' => 'required',
            'address' => 'required',
            'areas' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'progress_status_id' => 'required',
            // 'installment_length' => 'required',
            'meta_title' => 'required',
            'meta_tags' => 'required',
            'meta_description' => 'required',
        ];
    }
}
