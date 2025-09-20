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
            $table->string('boq_code')->unique();
            $table->string('sales_code')->unique();
            $table->enum('type_of_sales_code', ['FIT', 'Non FIT']);
            $table->year('year_of_sales');
            $table->enum('destination', ['Indonesia', 'Overseas']);
            $table->string('city');
            $table->enum('activity', [
                'Awarding', 
                'Conference and Seminar', 
                'Exhibitions', 
                'Gala Dinner', 
                'Gathering', 
                'Holidays', 
                'Incentive Trip', 
                'Meeting', 
                'Product Launching', 
                'Shareholders Meeting (RUPS)', 
                'Workshop', 
                'Others'
            ]);
            $table->date('date_from');
            $table->date('date_to');
            $table->string('invoice_no')->nullable();
            $table->enum('pricing_model', [
                'All inclusive package',
                'All inclusive - Price Per Person',
                'Simple package',
                'Free format',
                'Itemized'
            ]);
            $table->enum('status', ['draft', 'submitted', 'approved', 'rejected', 'cancelled'])->default('draft');
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
