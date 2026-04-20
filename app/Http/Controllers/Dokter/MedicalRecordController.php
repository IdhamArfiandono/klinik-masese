<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMedicalRecordRequest;
use App\Models\Appointment;
use App\Models\MedicalRecord;
use App\Models\Medicine;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MedicalRecordController extends Controller
{
    public function create(Request $request)
    {
        $appointment = Appointment::findOrFail($request->query('appointment'));

        abort_if($appointment->doctor_id !== auth()->user()->doctor->id, 403);
        abort_if($appointment->status === 'completed', 403, 'Rekam medis sudah dibuat.');

        $appointment->load('patient.user');
        $medicines = Medicine::orderBy('name')->get();

        return view('dokter.medical-records.create', compact('appointment', 'medicines'));
    }

    public function store(StoreMedicalRecordRequest $request)
    {
        $appointment = Appointment::findOrFail($request->input('appointment_id'));

        abort_if($appointment->doctor_id !== auth()->user()->doctor->id, 403);
        abort_if($appointment->status === 'completed', 403);

        DB::transaction(function () use ($request, $appointment) {
            $record = MedicalRecord::create([
                'appointment_id' => $appointment->id,
                'patient_id'     => $appointment->patient_id,
                'doctor_id'      => $appointment->doctor_id,
                'diagnosis'      => $request->diagnosis,
                'prescription'   => $request->prescription,
                'notes'          => $request->notes,
                'created_at'     => now(),
            ]);

            if ($request->filled('medicines')) {
                foreach ($request->medicines as $med) {
                    if (!empty($med['medicine_id'])) {
                        Prescription::create([
                            'medical_record_id' => $record->id,
                            'medicine_id'       => $med['medicine_id'],
                            'quantity'          => $med['quantity'],
                            'dosage'            => $med['dosage'],
                            'notes'             => $med['notes'] ?? null,
                        ]);
                    }
                }
            }

            $appointment->update(['status' => 'completed']);
        });

        return redirect()->route('dokter.appointments.index')->with('success', 'Rekam medis berhasil disimpan.');
    }

    public function show(MedicalRecord $medicalRecord)
    {
        $medicalRecord->load(['appointment', 'patient.user', 'prescriptions.medicine']);
        return view('dokter.medical-records.show', compact('medicalRecord'));
    }
}
