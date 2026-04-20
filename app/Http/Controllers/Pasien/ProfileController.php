<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        $user    = auth()->user();
        $patient = $user->patient;
        return view('pasien.profile.edit', compact('user', 'patient'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'phone'      => 'nullable|string|max:20',
            'birth_date' => 'nullable|date',
            'gender'     => 'nullable|in:L,P',
            'address'    => 'nullable|string',
            'blood_type' => 'nullable|string|max:5',
            'allergies'  => 'nullable|string',
        ]);

        $user    = auth()->user();
        $patient = $user->patient;

        $user->update([
            'name'  => $request->name,
            'phone' => $request->phone,
        ]);

        if ($patient) {
            $patient->update([
                'birth_date' => $request->birth_date,
                'gender'     => $request->gender,
                'address'    => $request->address,
                'blood_type' => $request->blood_type,
                'allergies'  => $request->allergies,
            ]);
        }

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}
