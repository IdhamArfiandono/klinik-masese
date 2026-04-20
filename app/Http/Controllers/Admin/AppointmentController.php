<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Appointment::with(['patient.user', 'doctor.user']);

        if ($request->filled('doctor_id')) {
            $query->where('doctor_id', $request->doctor_id);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('date')) {
            $query->whereDate('appointment_date', $request->date);
        }

        $appointments = $query->latest()->paginate(15);
        $doctors      = Doctor::with('user')->get();

        return view('admin.appointments.index', compact('appointments', 'doctors'));
    }

    public function show(Appointment $appointment)
    {
        $appointment->load(['patient.user', 'doctor.user', 'medicalRecord.prescriptions.medicine']);
        return view('admin.appointments.show', compact('appointment'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $request->validate(['status' => 'required|in:pending,confirmed,completed,cancelled']);
        $appointment->update(['status' => $request->status]);
        return back()->with('success', 'Status appointment diperbarui.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('admin.appointments.index')->with('success', 'Appointment dihapus.');
    }
}
