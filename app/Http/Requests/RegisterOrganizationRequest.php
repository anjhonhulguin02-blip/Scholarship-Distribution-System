<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterOrganizationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'organizationName' => ['required', 'string', 'max:150'],
            'firstName' => ['required', 'string', 'max:100'],
            'lastName' => ['required', 'string', 'max:100'],
            'address' => ['required', 'string', 'max:180'],
            'email' => ['required', 'email', 'max:50', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(10)->letters()->numbers()],
            'terms' => ['accepted'],
        ];
    }

    public function messages(): array
    {
        return [
            'firstName.required' => 'The authorized representative\'s first name is required.',
            'lastName.required' => 'The authorized representative\'s last name is required.',
            'terms.accepted' => 'You must accept the Privacy Policy and Terms & Conditions to create an account.',
            'email.unique' => 'An account with this email already exists.',
        ];
    }
}
