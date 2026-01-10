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
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
            $table->string('code')->unique();
            $table->string('sales_code')->unique()->nullable();
            $table->text('note')->nullable();
            $table->enum('status', ['Draft', 'Submitted', 'Win', 'Lose', 'Cancelled'])->default('Draft');
            $table->decimal('total_amount_items', 15, 2)->nullable();
            
            // Pricing Model fields
            $table->enum('pricing_model', ['A', 'B', 'C', 'D'])->nullable();
            $table->enum('management_fee_type', ['nominal', 'percent'])->default('percent');
            $table->decimal('management_fee', 15, 2)->default(0);
            $table->integer('vat_rate')->default(11);
            $table->text('pricing_model_description')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposals');
    }
};
