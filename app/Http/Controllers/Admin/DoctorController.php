<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDoctorRequest;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::with('user')->paginate(15);
        return view('admin.doctors.index', compact('doctors'));
    }

    public function create()
    {
        return view('admin.doctors.create');
    }

    public function store(StoreDoctorRequest $request)
    {
        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role'      => 'dokter',
            'phone'     => $request->phone,
            'is_active' => true,
        ]);

        Doctor::create([
            'user_id'          => $user->id,
            'specialization'   => $request->specialization,
            'education'        => $request->education,
            'experience_years' => $request->experience_years,
            'consultation_fee' => $request->consultation_fee,
            'schedule'         => $this->parseSchedule($request->schedule),
            'is_active'        => true,
        ]);

        return redirect()->route('admin.doctors.index')->with('success', 'Dokter berhasil ditambahkan.');
    }

    public function show(Doctor $doctor)
    {
        $doctor->load('user');
        return view('admin.doctors.show', compact('doctor'));
    }

    public function edit(Doctor $doctor)
    {
        $doctor->load('user');
        return view('admin.doctors.edit', compact('doctor'));
    }

    public function update(StoreDoctorRequest $request, Doctor $doctor)
    {
        $doctor->user->update([
            'name'  => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        if ($request->filled('password')) {
            $doctor->user->update(['password' => Hash::make($request->password)]);
        }

        $doctor->update([
            'specialization'   => $request->specialization,
            'education'        => $request->education,
            'experience_years' => $request->experience_years,
            'consultation_fee' => $request->consultation_fee,
            'schedule'         => $this->parseSchedule($request->schedule) ?: $doctor->schedule,
        ]);

        return redirect()->route('admin.doctors.index')->with('success', 'Data dokter diperbarui.');
    }

    public function destroy(Doctor $doctor)
    {
        $doctor->user->delete();
        return redirect()->route('admin.doctors.index')->with('success', 'Dokter dihapus.');
    }

    private function parseSchedule(?array $raw): array
    {
        if (!$raw) return [];
        $result = [];
        foreach ($raw as $day => $times) {
            if (!empty($times)) {
                $result[$day] = array_filter(array_map('trim', explode(',', $times)));
            }
        }
        return $result;
    }

    public function toggle(Doctor $doctor)
    {
        $doctor->update(['is_active' => !$doctor->is_active]);
        $doctor->user->update(['is_active' => !$doctor->user->is_active]);
        $status = $doctor->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return back()->with('success', "Dokter berhasil {$status}.");
    }
}
