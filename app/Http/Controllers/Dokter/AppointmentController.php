<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $doctor = auth()->user()->doctor;
        $query  = Appointment::where('doctor_id', $doctor->id)->with('patient.user');

        if ($request->filled('date')) {
            $query->whereDate('appointment_date', $request->date);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $appointments = $query->orderBy('appointment_date')->orderBy('appointment_time')->paginate(15);
        return view('dokter.appointments.index', compact('appointments'));
    }

    public function show(Appointment $appointment)
    {
        $appointment->load(['patient.user', 'medicalRecord.prescriptions.medicine']);
        return view('dokter.appointments.show', compact('appointment'));
    }

    public function confirm(Appointment $appointment)
    {
        abort_if($appointment->doctor_id !== auth()->user()->doctor->id, 403);
        $appointment->update(['status' => 'confirmed']);
        return back()->with('success', 'Appointment dikonfirmasi.');
    }
}
