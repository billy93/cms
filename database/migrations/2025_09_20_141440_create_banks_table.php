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
    Schema::create('banks', function (Blueprint $table) {
        // 1. Primary Key
        $table->id(); 

        // 2. Bank Code (e.g., "014" for BCA)
        // Modified to char(3)
        $table->char('bank_code', 3)->unique(); 

        // 3. Bank Name (e.g., "Chase Bank")
        $table->string('bank_name')->index();

        // 3b. Bank Brand (New column from merged migration)
        $table->string('bank_brand', 50)->nullable();

        // 4. Bank Address
        // I used 'text' instead of 'string' allows for longer addresses.
        // nullable() means it's okay if a bank doesn't have an address yet.
        $table->text('bank_address')->nullable(); 

        // 5. Timestamps (created_at, updated_at)
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banks');
    }
};
