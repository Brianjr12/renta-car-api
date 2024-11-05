<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'model' => 'required|string|max:255',
            'brand_id' => 'required|integer|exists:brands,id',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'price_per_day' => 'required|numeric|min:0',
            'color' => 'required|string|max:100',
            'description' => 'nullable|string',
            'availability' => 'required|boolean',
            'popularity' => 'required|integer|min:0',
        ];
    }

    /**
     * Get custom messages for validation errors.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'model.required' => 'The model field is required.',
            'model.string' => 'The model must be a string.',
            'model.max' => 'The model must not exceed 255 characters.',
            'brand_id.required' => 'The brand ID field is required.',
            'brand_id.integer' => 'The brand ID must be an integer.',
            'brand_id.exists' => 'The selected brand ID does not exist.',
            'year.required' => 'The year field is required.',
            'year.integer' => 'The year must be an integer.',
            'year.min' => 'The year must be at least 1900.',
            'year.max' => 'The year must not exceed ' . (date('Y') + 1) . '.',
            'price_per_day.required' => 'The price per day field is required.',
            'price_per_day.numeric' => 'The price per day must be a number.',
            'price_per_day.min' => 'The price per day must be at least 0.',
            'color.required' => 'The color field is required.',
            'color.string' => 'The color must be a string.',
            'color.max' => 'The color must not exceed 100 characters.',
            'description.string' => 'The description must be a string.',
            'availability.required' => 'The availability field is required.',
            'availability.boolean' => 'The availability must be true or false.',
            'popularity.required' => 'The popularity field is required.',
            'popularity.integer' => 'The popularity must be an integer.',
            'popularity.min' => 'The popularity must be at least 0.',
        ];
    }
}
