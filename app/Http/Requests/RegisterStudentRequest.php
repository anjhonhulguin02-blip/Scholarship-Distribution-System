<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'firstName' => ['required', 'string', 'max:100'],
            'middleName' => ['nullable', 'string', 'max:100'],
            'lastName' => ['required', 'string', 'max:100'],
            'address' => ['required', 'string', 'max:180'],
            'birthDate' => [
                'required',
                'date',
                'before_or_equal:' . now()->subYears(18)->format('Y-m-d'),
            ],
            'gender' => ['required', 'in:male,female'],
            'email' => ['required', 'email', 'max:50', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(10)->letters()->numbers()],
            'terms' => ['accepted'],
        ];
    }

    public function messages(): array
    {
        return [
            'birthDate.before_or_equal' => 'You must be at least 18 years old to register.',
            'terms.accepted' => 'You must accept the Privacy Policy and Terms & Conditions to create an account.',
            'email.unique' => 'An account with this email already exists.',
        ];
    }
}
