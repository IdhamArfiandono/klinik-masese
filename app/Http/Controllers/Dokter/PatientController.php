<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $doctor = auth()->user()->doctor;
        $query  = Patient::whereHas('appointments', fn($q) => $q->where('doctor_id', $doctor->id))
            ->with('user');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', fn($q) => $q->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%"));
        }

        $patients = $query->paginate(15);
        return view('dokter.patients.index', compact('patients'));
    }

    public function show(Patient $patient)
    {
        $doctor  = auth()->user()->doctor;
        $records = $patient->medicalRecords()
            ->where('doctor_id', $doctor->id)
            ->with('prescriptions.medicine', 'appointment')
            ->latest('created_at')
            ->get();

        $patient->load('user');
        return view('dokter.patients.show', compact('patient', 'records'));
    }
}
