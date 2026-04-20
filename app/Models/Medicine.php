<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medicine extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'category', 'description', 'price', 'stock', 'unit',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
    ];

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }

    public function transactionItems()
    {
        return $this->hasMany(TransactionItem::class);
    }

    public function isLowStock(): bool
    {
        return $this->stock < 10;
    }
}
