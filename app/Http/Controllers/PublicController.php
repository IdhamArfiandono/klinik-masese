<?php

namespace App\Http\Controllers;

use App\Models\Doctor;

class PublicController extends Controller
{
    public function index()
    {
        $doctors = Doctor::with('user')->where('is_active', true)->get();
        return view('public.index', compact('doctors'));
    }

    public function doctors()
    {
        $doctors = Doctor::with('user')->where('is_active', true)->paginate(12);
        return view('public.doctors', compact('doctors'));
    }
}
