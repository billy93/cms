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

        // 2. Bank Code (e.g., "BCA")
        // I added 'unique' so you don't accidental create two banks with the same code.
        $table->string('bank_code')->unique(); 

        // 3. Bank Name (e.g., "Chase Bank")
        $table->string('bank_name')->index();

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
