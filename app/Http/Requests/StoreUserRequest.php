<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('user') ? $this->route('user')->id : null;
        return [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'unique:users,email,' . $userId],
            'password' => [$this->isMethod('POST') ? 'required' : 'nullable', 'string', 'min:6'],
            'role'     => ['required', 'in:admin,dokter,apoteker,pasien'],
            'phone'    => ['nullable', 'string', 'max:20'],
        ];
    }
}
