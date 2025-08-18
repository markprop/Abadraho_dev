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
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'discount_price' => 'required|numeric|min:0',
            'areas' => 'required|array',
            'areas.*' => 'exists:areas,id',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'progress_status_id' => 'required|exists:progress_status,id',
            'status' => 'required|in:1,2,3',
            'project_doc' => 'nullable|file|mimes:pdf|max:2048',
            'project_video' => 'nullable|file|mimes:mp4|max:102400',
            'project_cover_img' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'project_imgs.*' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'details' => 'required|string',
            'main_heading' => 'required|string|max:255',
            'sub_heading' => 'required|string|max:255',
            'bullet_1' => 'required|string|max:255',
            'bullet_2' => 'required|string|max:255',
            'bullet_3' => 'required|string|max:255',
            'bullet_4' => 'required|string|max:255',
            'bullet_5' => 'nullable|string|max:255',
            'bullet_6' => 'nullable|string|max:255',
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string|max:500',
            'meta_tags' => 'required|string|max:500',
            'owners' => 'nullable|array',
            'owners.*' => 'exists:builders,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'marketed_by' => 'nullable|string|max:255',
            'added_time' => 'nullable|date',
        ];
    }
}