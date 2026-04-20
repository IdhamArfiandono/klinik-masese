<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'doctor_id'        => ['required', 'exists:doctors,id'],
            'appointment_date' => ['required', 'date', 'after_or_equal:today'],
            'appointment_time' => ['required'],
            'complaint'        => ['required', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'doctor_id.required'        => 'Pilih dokter terlebih dahulu.',
            'appointment_date.required' => 'Tanggal appointment wajib diisi.',
            'appointment_date.after_or_equal' => 'Tanggal tidak boleh di masa lalu.',
            'appointment_time.required' => 'Jam appointment wajib dipilih.',
            'complaint.required'        => 'Keluhan wajib diisi.',
        ];
    }
}
