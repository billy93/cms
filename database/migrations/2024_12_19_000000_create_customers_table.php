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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_code')->unique()->comment('Kode unik customer');
            $table->string('customer_name')->comment('Nama customer/perusahaan');
            $table->text('address')->comment('Alamat lengkap customer');
            $table->string('contact_person')->nullable()->comment('Nama kontak person');
            $table->string('phone')->nullable()->comment('Nomor telepon');
            $table->string('email')->nullable()->comment('Email customer');
            $table->enum('status', ['active', 'inactive'])->default('active')->comment('Status customer');
            $table->text('notes')->nullable()->comment('Catatan tambahan');
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index('customer_code');
            $table->index('customer_name');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
}; 