<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'appointment_id', 'patient_id', 'doctor_id', 'diagnosis', 'prescription', 'notes',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }
}
