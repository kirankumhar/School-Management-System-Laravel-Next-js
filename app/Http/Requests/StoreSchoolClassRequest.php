<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSchoolClassRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:school_classes,name',
            'numeric_name' => 'required|integer|unique:school_classes,numeric_name',
            'description' => 'nullable|string|max:500',
            'capacity' => 'required|integer|min:1|max:100',
            'class_teacher_id' => 'nullable|exists:teachers,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Class name is required',
            'name.unique' => 'This class name already exists',
            'numeric_name.required' => 'Numeric name is required',
            'numeric_name.unique' => 'This numeric name already exists',
            'capacity.min' => 'Capacity must be at least 1',
            'capacity.max' => 'Capacity cannot exceed 100',
            'class_teacher_id.exists' => 'Selected teacher does not exist',
        ];
    }
}
