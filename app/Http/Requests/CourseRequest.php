<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
            //
            'name' => 'required',
            'code' => 'required',
            'description' => 'required',
            'summary' => 'required',
            'requirement' => 'required',
            'teacher_id' => 'nullable',
            'category_id' => 'required',
            'status' => 'required',
            'price' => 'required',
            'duration' => 'required',
            'started_at' => 'required',
            'finished_at' => 'required',
            'image' => 'nullable',
        ];
    }
}
