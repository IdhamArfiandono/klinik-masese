<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppointmentRequest;
use App\Models\Appointment;
use App\Models\Doctor;

class AppointmentController extends Controller
{
    public function index()
    {
        $patient = auth()->user()->patient;
        $appointments = Appointment::where('patient_id', $patient->id)
            ->with(['doctor.user', 'medicalRecord'])
            ->latest('appointment_date')
            ->paginate(10);

        return view('pasien.appointments.index', compact('appointments'));
    }

    public function create()
    {
        $doctors = Doctor::with('user')->where('is_active', true)->get();
        return view('pasien.appointments.create', compact('doctors'));
    }

    public function store(StoreAppointmentRequest $request)
    {
        $patient = auth()->user()->patient;

        // Cek konflik jadwal
        $konflik = Appointment::where('patient_id', $patient->id)
            ->whereDate('appointment_date', $request->appointment_date)
            ->whereTime('appointment_time', $request->appointment_time)
            ->whereNotIn('status', ['cancelled'])
            ->exists();

        if ($konflik) {
            return back()->withErrors(['appointment_time' => 'Anda sudah memiliki appointment pada waktu ini.'])->withInput();
        }

        // Cek konflik dokter
        $konflikDokter = Appointment::where('doctor_id', $request->doctor_id)
            ->whereDate('appointment_date', $request->appointment_date)
            ->whereTime('appointment_time', $request->appointment_time)
            ->whereNotIn('status', ['cancelled'])
            ->exists();

        if ($konflikDokter) {
            return back()->withErrors(['appointment_time' => 'Jam tersebut sudah dipesan oleh pasien lain.'])->withInput();
        }

        Appointment::create([
            'patient_id'       => $patient->id,
            'doctor_id'        => $request->doctor_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'complaint'        => $request->complaint,
            'status'           => 'pending',
        ]);

        return redirect()->route('pasien.appointments.index')->with('success', 'Appointment berhasil dibuat. Menunggu konfirmasi dokter.');
    }

    public function show(Appointment $appointment)
    {
        abort_if($appointment->patient_id !== auth()->user()->patient->id, 403);
        $appointment->load(['doctor.user', 'medicalRecord.prescriptions.medicine']);
        return view('pasien.appointments.show', compact('appointment'));
    }

    public function cancel(Appointment $appointment)
    {
        abort_if($appointment->patient_id !== auth()->user()->patient->id, 403);
        abort_if(!in_array($appointment->status, ['pending', 'confirmed']), 403);
        $appointment->update(['status' => 'cancelled']);
        return back()->with('success', 'Appointment dibatalkan.');
    }
}
