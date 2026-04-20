<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Transaction;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPasien        = Patient::count();
        $appointmentHariIni = Appointment::whereDate('appointment_date', today())->count();
        $appointmentPending = Appointment::where('status', 'pending')->with(['patient.user', 'doctor.user'])->latest()->paginate(5);
        $pendapatanBulanIni = Transaction::where('status', 'paid')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total_amount');

        return view('admin.dashboard', compact(
            'totalPasien', 'appointmentHariIni', 'appointmentPending', 'pendapatanBulanIni'
        ));
    }
}
