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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('ref_doc_no'); 
            $table->decimal('value', 20, 2); 
            $table->date('start_date'); 
            $table->date('end_date'); 
            $table->date('due_date'); 
            $table->text('description')->nullable();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade')->nullable();
            $table->enum('status', ['Active', 'Inactive', 'Completed', 'Cancelled'])->default('Active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
