<?php

namespace App\Http\Controllers\Apoteker;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use App\Models\MedicalRecord;

class DashboardController extends Controller
{
    public function index()
    {
        $resepMasuk = MedicalRecord::whereDoesntHave('transaction')
            ->whereHas('prescriptions')
            ->with(['patient.user', 'prescriptions'])
            ->latest('created_at')
            ->get();

        $stokHampirHabis = Medicine::where('stock', '<', 10)->whereNull('deleted_at')->get();

        return view('apoteker.dashboard', compact('resepMasuk', 'stokHampirHabis'));
    }
}
