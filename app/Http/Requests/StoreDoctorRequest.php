<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDoctorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('doctor') ? $this->route('doctor')->user_id : null;
        return [
            'name'             => ['required', 'string', 'max:255'],
            'email'            => ['required', 'email', 'unique:users,email,' . $userId],
            'password'         => [$this->isMethod('POST') ? 'required' : 'nullable', 'string', 'min:6'],
            'phone'            => ['nullable', 'string', 'max:20'],
            'specialization'   => ['required', 'string', 'max:100'],
            'education'        => ['nullable', 'string'],
            'experience_years' => ['required', 'integer', 'min:0'],
            'consultation_fee' => ['required', 'numeric', 'min:0'],
            'schedule'         => ['nullable', 'array'],
        ];
    }
}
