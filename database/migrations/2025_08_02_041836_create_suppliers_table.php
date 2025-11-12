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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique()->comment('Kode unik supplier');
            $table->string('name')->comment('Nama supplier/perusahaan');
            $table->text('address')->comment('Alamat lengkap supplier');
            $table->string('contact_person')->nullable()->comment('Nama kontak person');
            $table->string('phone')->comment('Nomor telepon');
            $table->string('email')->nullable()->comment('Email supplier');
            $table->string('tax_number')->nullable()->comment('Nomor NPWP');
            $table->string('bank_name')->nullable()->comment('Nama bank');
            $table->string('bank_account_number')->nullable()->comment('Nomor rekening bank');
            $table->string('bank_account_name')->nullable()->comment('Nama pemilik rekening');
            $table->enum('status', ['Active', 'Inactive'])->default('Active')->comment('Status supplier');
            $table->text('notes')->nullable()->comment('Catatan tambahan');
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index('code');
            $table->index('name');
            $table->index('status');
            $table->index('tax_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
