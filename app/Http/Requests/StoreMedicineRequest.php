<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMedicineRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('medicine');
        return [
            'name'        => ['required', 'string', 'max:255'],
            'category'    => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'price'       => ['required', 'numeric', 'min:0'],
            'stock'       => ['required', 'integer', 'min:0'],
            'unit'        => ['required', 'in:tablet,kapsul,botol,tube,ampul,sachet'],
        ];
    }
}
