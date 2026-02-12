<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('account_categories', function (Blueprint $table) {
            $table->id();
            $table->string('category_code', 20)->unique();
            $table->string('category_name', 100);
            $table->enum('category_type', ['Expense', 'Income', 'Other']);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['category_type', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('account_categories');
    }
};
