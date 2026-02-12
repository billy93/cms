<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sales_items', function (Blueprint $table) {
            $table->id();

            // Hybrid Flow: Parent can be Project (Direct Transaction) OR Proposal (Regular Flow)
            $table->foreignId('project_id')
                  ->nullable()
                  ->constrained('projects')
                  ->cascadeOnDelete();

            $table->foreignId('proposal_id')
                  ->nullable()
                  ->constrained('proposals')
                  ->cascadeOnDelete();

            $table->foreignId('invoice_id')
                  ->nullable()
                  ->constrained('invoices')
                  ->nullOnDelete();
                  
            $table->foreignId('product_id')
                  ->nullable() 
                  ->constrained('products')
                  ->cascadeOnDelete();
            
            $table->foreignId('product_price_version_id')
                  ->nullable()
                  ->constrained('product_price_versions')
                  ->nullOnDelete();
            
            // Snapshot data
            $table->text('description')->nullable();
            $table->decimal('selling_price', 15, 2);
            
            $table->string('title1_key')->nullable();
            $table->integer('title1_value')->nullable();

            $table->string('title2_key')->nullable();
            $table->integer('title2_value')->nullable();

            $table->string('title3_key')->nullable();
            $table->integer('title3_value')->nullable();

            $table->string('title4_key')->nullable();
            $table->integer('title4_value')->nullable();

            $table->decimal('total_price', 15, 2);

            // Header grouping for Type B/C/D pricing model
            $table->string('header')->nullable();
            $table->string('subheader')->nullable();
            $table->integer('header_order')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales_items');
    }
};
