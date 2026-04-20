<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        $patient = auth()->user()->patient;

        $appointmentMendatang = Appointment::where('patient_id', $patient->id)
            ->whereIn('status', ['pending', 'confirmed'])
            ->whereDate('appointment_date', '>=', today())
            ->with('doctor.user')
            ->orderBy('appointment_date')
            ->get();

        $riwayatKunjungan = Appointment::where('patient_id', $patient->id)
            ->where('status', 'completed')
            ->with(['doctor.user', 'medicalRecord'])
            ->latest('appointment_date')
            ->limit(5)
            ->get();

        $riwayatPembelian = Transaction::where('patient_id', $patient->id)
            ->with('items.medicine')
            ->latest()
            ->limit(5)
            ->get();

        return view('pasien.dashboard', compact('appointmentMendatang', 'riwayatKunjungan', 'riwayatPembelian'));
    }
}
