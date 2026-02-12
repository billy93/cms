<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('account_code', 30)->unique();
            $table->string('account_name', 150);

            $table->foreignId('category_id')
                ->constrained('account_categories')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->enum('normal_balance', ['DEBIT', 'CREDIT']);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['category_id', 'is_active']);
            $table->index(['normal_balance']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
