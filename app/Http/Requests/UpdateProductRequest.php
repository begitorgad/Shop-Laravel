<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Closure;


class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
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
        $product = $this->route('product'); // route model binding (Product)

        return [
            'category_id' => ['required', Rule::exists('categories', 'id')],

            'name' => ['required', 'string', 'max:255',],
            'slug' => ['required', 'string','max:255', Rule::unique('products', 'slug')->ignore($product->id)],
            'description' => [
                Rule::requiredIf(fn () => $this->boolean('active')),
                'nullable',
                'string',
                'min:50',
            ],
            'price'       => ['required', 'numeric', 'min:0'],
            'stock' => [
                'required',
                'integer',
                'min:0',
                function (string $attribute, mixed $value, Closure $fail) use ($product) {
                    $inProgressQty = $product->orderItems()
                        ->whereHas('order', function ($q) {
                            $q->whereIn('status', ['pending', 'paid', 'shipped']);
                        })
                        ->sum('quantity');

                    if ((int) $value < $inProgressQty) {
                        $fail("Stock can't be lower than {$inProgressQty} because there are orders in progress.");
                    }
                },
            ],
            'discount'    => ['nullable', 'integer', 'min:0', 'max:100'],
            'image'       => ['nullable', 'image'],
            'active'      => ['nullable', 'boolean'],

            'tags'   => ['nullable', 'array'],
            'tags.*' => ['integer', Rule::exists('tags', 'id')],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            if ($this->boolean('active') && empty($this->category_id)) {
                $validator->errors()->add('category_id',
                    'Un produit actif doit avoir une catégorie.');
            }
        });
    }
}