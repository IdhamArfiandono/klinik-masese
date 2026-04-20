<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMedicalRecordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'appointment_id'         => ['required', 'exists:appointments,id'],
            'diagnosis'              => ['required', 'string'],
            'prescription'           => ['nullable', 'string'],
            'notes'                  => ['nullable', 'string'],
            'medicines'              => ['nullable', 'array'],
            'medicines.*.medicine_id'=> ['required', 'exists:medicines,id'],
            'medicines.*.quantity'   => ['required', 'integer', 'min:1'],
            'medicines.*.dosage'     => ['required', 'string'],
            'medicines.*.notes'      => ['nullable', 'string'],
        ];
    }
}
