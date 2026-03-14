<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
//use App\Rules\StrongPassword;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // add policy later if needed
    }

    protected function prepareForValidation(): void
    {
        if ($this->filled('phone')) {
            $phone = preg_replace('/\s+/', '', $this->phone); // remove spaces

            // Example: default country = France (+33)
            if (str_starts_with($phone, '0')) {
                $phone = '+33' . substr($phone, 1);
            }

            if (!str_starts_with($phone, '+')) {
                $phone = '+' . $phone;
            }

            $this->merge([
                'phone' => $phone,
            ]);
        }
    }
    
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email'),
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                //new StrongPassword,
                Password::min(8)
                ->letters()      
                ->mixedCase()     
                ->numbers()       
                ->symbols(),
            ],

            'is_admin' => ['sometimes', 'boolean'],
        ];
    }
}