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
        Schema::create('pdf_templates', function (Blueprint $table) {
            $table->id();
            
            // Template name (unique)
            $table->string('name')->unique();
            
            // Template type (proposal or invoice)
            $table->enum('type', ['proposal', 'invoice']);
            
            // HTML content for the template
            $table->longText('html_content');
            
            // Variables definition (stored as JSON)
            // Format: [{"name": "customer_name", "label": "Customer Name"}, ...]
            $table->json('variables')->nullable();
            
            // Optional description
            $table->text('description')->nullable();
            
            // Active status
            $table->boolean('is_active')->default(true);
            
            $table->timestamps();
            
            // Indexes
            $table->index('type');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pdf_templates');
    }
};
