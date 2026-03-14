<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Slug implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Le slug doit contenir uniquement des lettres, chiffres et tirets
        if (!preg_match('/^[a-z0-9]+(?:-[a-z0-9]+)*$/', $value)) {
            $fail('Not a valid slug. Only lowercases, dashes and numbers allowed.');
        }
    }
}
