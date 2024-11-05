<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordConfirmRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|confirmed|min:8',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'The email field is required.',
            'email.email' => 'Please provide a valid email address.',
            'token.required' => 'The reset token is required.',
            'password.required' => 'The password field is required.',
            'password.confirmed' => 'Password confirmation does not match.',
            'password.min' => 'The password must be at least 8 characters.',
        ];
    }
}
