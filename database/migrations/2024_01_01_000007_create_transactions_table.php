<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->foreignId('apoteker_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('medical_record_id')->nullable()->constrained('medical_records')->onDelete('set null');
            $table->decimal('total_amount', 12, 2)->default(0);
            $table->enum('status', ['pending', 'paid'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
