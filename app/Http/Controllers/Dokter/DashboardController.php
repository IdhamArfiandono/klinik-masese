<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Appointment;

class DashboardController extends Controller
{
    public function index()
    {
        $doctor = auth()->user()->doctor;

        $appointmentHariIni = Appointment::where('doctor_id', $doctor->id)
            ->whereDate('appointment_date', today())
            ->with('patient.user')
            ->orderBy('appointment_time')
            ->get();

        $totalPasienBulanIni = Appointment::where('doctor_id', $doctor->id)
            ->where('status', 'completed')
            ->whereMonth('appointment_date', now()->month)
            ->whereYear('appointment_date', now()->year)
            ->count();

        return view('dokter.dashboard', compact('appointmentHariIni', 'totalPasienBulanIni'));
    }
}
