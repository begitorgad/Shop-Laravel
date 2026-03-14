<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        // change later if you add roles
        return true;
    }

    protected function prepareForValidation(): void
    {
        if (empty($this->slug) && !empty($this->name)) {
            $this->merge([
                'slug' => Str::slug($this->name),
            ]);
        }

        if ($this->has('name')) {
            $this->merge([
                'name' => trim($this->name),
            ]);
        }

        if ($this->has('price')) {
            $this->merge([
                'price' => round((float) $this->price, 2),
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'category_id' => ['required', 'exists:categories,id'],
            'name'        => ['required', 'string', /** 'min:3',*/ 'max:255'],
            'slug'        => ['required', 'string','max255', Rule::unique('products', 'slug')],
            'description' => ['nullable', 'string'],
            'price'       => ['required', 'numeric', 'min:0'],
            'stock'       => ['required', 'integer', 'min:0'],
            'image'       => ['nullable', 'image'],
            'active'      => ['nullable', 'boolean'],
            'discount'    => ['nullable','integer', 'min:0', 'max:100'],
            'tags'        => ['nullable', 'array'],
            'tags.*'      => ['integer', 'exists:tags,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name is required cuh.',
            'price.required' => 'Need a price with that bad boy.',
        ];
    }
}