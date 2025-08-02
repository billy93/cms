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
        Schema::table('customers', function (Blueprint $table) {
            $table->string('bank_name')->nullable()->after('email')->comment('Nama bank');
            $table->string('bank_account_number')->nullable()->after('bank_name')->comment('Nomor rekening bank');
            $table->string('bank_account_name')->nullable()->after('bank_account_number')->comment('Nama pemilik rekening');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn(['bank_name', 'bank_account_number', 'bank_account_name']);
        });
    }
};
