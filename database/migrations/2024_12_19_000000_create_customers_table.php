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
            $table->string('code')->unique()->comment('Kode unik customer');
            $table->string('name')->comment('Nama customer/perusahaan');
            $table->string('bank_name')->nullable()->comment('Nama bank');
            $table->string('bank_account_number')->nullable()->comment('Nomor rekening bank');
            $table->string('bank_account_name')->nullable()->comment('Nama pemilik rekening');
            $table->enum('status', ['Active', 'Inactive'])->default('Active')->comment('Status customer');
            $table->text('notes')->nullable()->comment('Catatan tambahan');
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index('code');
            $table->index('name');
            $table->index('status');
        });

        Schema::create('billing_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();
            
            // Contact Person
            $table->string('cp_name')->nullable();
            $table->string('cp_title_division')->nullable();
            $table->string('cp_email')->nullable();
            $table->string('cp_office_number')->nullable();
            $table->string('cp_mobile_number')->nullable();

            // Billing Address
            $table->boolean('is_overseas')->default(false);
            $table->text('address')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billing_options');
        Schema::dropIfExists('customers');
    }
}; 