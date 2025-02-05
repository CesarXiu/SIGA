<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->rol === 'admin';;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $passwordRequired = $this->getMethod() === 'POST' ? 'required' : 'nullable';
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => [
                $passwordRequired,
                'string',
                'min:8', // Minimum length of 8 characters
                'regex:/[a-z]/', // At least one lowercase letter
                'regex:/[A-Z]/', // At least one uppercase letter
                'regex:/[0-9]/', // At least one digit
                'regex:/[@$!%*#?&]/', // At least one special character
            ],
            'rol' => 'required|string|in:user,admin',
        ];
    }
}
