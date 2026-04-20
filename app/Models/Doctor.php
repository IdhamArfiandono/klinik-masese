<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'specialization', 'education', 'experience_years',
        'consultation_fee', 'schedule', 'photo_url', 'is_active',
    ];

    protected $casts = [
        'schedule' => 'array',
        'is_active' => 'boolean',
        'consultation_fee' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class);
    }
}
