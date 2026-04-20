<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category');
            $table->text('description')->nullable();
            $table->decimal('price', 12, 2)->default(0);
            $table->integer('stock')->default(0);
            $table->enum('unit', ['tablet', 'kapsul', 'botol', 'tube', 'ampul', 'sachet'])->default('tablet');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medicines');
    }
};
