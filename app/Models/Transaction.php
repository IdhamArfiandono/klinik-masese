<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id', 'apoteker_id', 'medical_record_id', 'total_amount', 'status',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function apoteker()
    {
        return $this->belongsTo(User::class, 'apoteker_id');
    }

    public function medicalRecord()
    {
        return $this->belongsTo(MedicalRecord::class);
    }

    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }
}
