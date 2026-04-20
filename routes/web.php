<?php

use App\Http\Controllers\Admin\AppointmentController as AdminAppointmentController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\DoctorController as AdminDoctorController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Apoteker\DashboardController as ApotekerDashboardController;
use App\Http\Controllers\Apoteker\MedicineController as ApotekerMedicineController;
use App\Http\Controllers\Apoteker\PrescriptionController as ApotekerPrescriptionController;
use App\Http\Controllers\Apoteker\TransactionController as ApotekerTransactionController;
use App\Http\Controllers\Dokter\AppointmentController as DokterAppointmentController;
use App\Http\Controllers\Dokter\DashboardController as DokterDashboardController;
use App\Http\Controllers\Dokter\MedicalRecordController as DokterMedicalRecordController;
use App\Http\Controllers\Dokter\PatientController as DokterPatientController;
use App\Http\Controllers\Pasien\AppointmentController as PasienAppointmentController;
use App\Http\Controllers\Pasien\DashboardController as PasienDashboardController;
use App\Http\Controllers\Pasien\ProfileController as PasienProfileController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/dokter', [PublicController::class, 'doctors'])->name('public.doctors');

// Auth Routes (Breeze)
require __DIR__.'/auth.php';

// Authenticated Routes
Route::middleware(['auth'])->group(function () {

    // Admin Routes
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('appointments', AdminAppointmentController::class)->only(['index', 'show', 'update', 'destroy']);
        Route::resource('doctors', AdminDoctorController::class);
        Route::patch('doctors/{doctor}/toggle', [AdminDoctorController::class, 'toggle'])->name('doctors.toggle');
        Route::resource('users', AdminUserController::class);
        Route::patch('users/{user}/toggle', [AdminUserController::class, 'toggle'])->name('users.toggle');
        Route::get('/reports', [AdminReportController::class, 'index'])->name('reports.index');
    });

    // Dokter Routes
    Route::middleware(['role:dokter'])->prefix('dokter')->name('dokter.')->group(function () {
        Route::get('/dashboard', [DokterDashboardController::class, 'index'])->name('dashboard');
        Route::resource('appointments', DokterAppointmentController::class)->only(['index', 'show']);
        Route::patch('appointments/{appointment}/confirm', [DokterAppointmentController::class, 'confirm'])->name('appointments.confirm');
        Route::resource('medical-records', DokterMedicalRecordController::class)->only(['create', 'store', 'show']);
        Route::get('patients', [DokterPatientController::class, 'index'])->name('patients.index');
        Route::get('patients/{patient}', [DokterPatientController::class, 'show'])->name('patients.show');
    });

    // Apoteker Routes
    Route::middleware(['role:apoteker'])->prefix('apoteker')->name('apoteker.')->group(function () {
        Route::get('/dashboard', [ApotekerDashboardController::class, 'index'])->name('dashboard');
        Route::get('prescriptions', [ApotekerPrescriptionController::class, 'index'])->name('prescriptions.index');
        Route::get('prescriptions/{medicalRecord}', [ApotekerPrescriptionController::class, 'show'])->name('prescriptions.show');
        Route::post('prescriptions/{medicalRecord}/process', [ApotekerPrescriptionController::class, 'process'])->name('prescriptions.process');
        Route::resource('medicines', ApotekerMedicineController::class);
        Route::patch('medicines/{medicine}/restock', [ApotekerMedicineController::class, 'restock'])->name('medicines.restock');
        Route::get('transactions', [ApotekerTransactionController::class, 'index'])->name('transactions.index');
        Route::get('transactions/{transaction}', [ApotekerTransactionController::class, 'show'])->name('transactions.show');
    });

    // Pasien Routes
    Route::middleware(['role:pasien'])->prefix('pasien')->name('pasien.')->group(function () {
        Route::get('/dashboard', [PasienDashboardController::class, 'index'])->name('dashboard');
        Route::resource('appointments', PasienAppointmentController::class)->only(['index', 'create', 'store', 'show']);
        Route::patch('appointments/{appointment}/cancel', [PasienAppointmentController::class, 'cancel'])->name('appointments.cancel');
        Route::get('/profile', [PasienProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [PasienProfileController::class, 'update'])->name('profile.update');
    });
});
