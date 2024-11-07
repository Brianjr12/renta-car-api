<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Ajusta según la lógica de autorización
    }

    public function rules()
    {
        return [
            'car_id' => 'required|exists:cars,id',       // ID del auto, que debe existir
            'start_date' => 'required|date|after:today', // Fecha de inicio
            'end_date' => 'required|date|after:start_date', // Fecha de finalización posterior a start_date
            'total_price' => 'required|numeric|min:0',   // Precio total
        ];
    }

    public function messages()
    {
        return [
            'car_id.required' => 'The car ID is required.',
            'car_id.exists' => 'The selected car does not exist.',
            'start_date.required' => 'The start date is required.',
            'start_date.after' => 'The start date must be after today.',
            'end_date.required' => 'The end date is required.',
            'end_date.after' => 'The end date must be after the start date.',
            'total_price.required' => 'The total price is required.',
            'total_price.numeric' => 'The total price must be a number.',
            'total_price.min' => 'The total price must be at least 0.',
        ];
    }
}
