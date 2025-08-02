<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('supplier_pics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->constrained('suppliers')->onDelete('cascade');
            $table->string('name')->comment('Nama PIC');
            $table->string('email')->nullable()->comment('Email PIC');
            $table->string('phone')->nullable()->comment('Nomor telepon PIC');
            $table->string('position')->nullable()->comment('Jabatan PIC');
            $table->enum('status', ['active', 'inactive'])->default('active')->comment('Status PIC');
            $table->text('notes')->nullable()->comment('Catatan tambahan');
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index('supplier_id');
            $table->index('name');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_pics');
    }
};
