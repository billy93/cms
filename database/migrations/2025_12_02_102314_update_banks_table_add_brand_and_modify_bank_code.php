<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('banks', function (Blueprint $table) {
            // 1. Add new column bank_brand (string 15 chars)
            $table->string('bank_brand', 15)->after('bank_name')->nullable();

            // 2. Modify bank_code → char(3) numeric
            $table->char('bank_code', 3)->change();
        });
    }

    public function down(): void
    {
        Schema::table('banks', function (Blueprint $table) {
            // Reverse adding column
            $table->dropColumn('bank_brand');

            // Revert bank_code to previous type (string, no length limit)
            $table->string('bank_code')->change();
        });
    }
};

