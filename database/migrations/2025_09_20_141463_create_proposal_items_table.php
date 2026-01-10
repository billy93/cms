<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proposal_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('proposal_id')
                  ->constrained('proposals')
                  ->cascadeOnDelete();

            $table->foreignId('invoice_id')
                  ->nullable()
                  ->constrained('invoices')
                  ->nullOnDelete();
                  
            $table->foreignId('product_id')
                  ->nullable() // Proposal items might not always be linked to a product directly (e.g. ad-hoc items), verifying this assumption? boq_items had it nullable? checking previous file... 
                  // Wait, boq_items file I read: 
                  // $table->foreignId('product_id')->constrained('products')->cascadeOnDelete(); 
                  // It was NOT nullable in boq_items. use matching logic unless user said otherwise. User didn't specify, but often proposal items are flexible. 
                  // However, strict duplicate means constrained. But typical BOQ items usually need a product. 
                  // Let's stick to the boq_items definition for product_id to be safe, but wait, 
                  // In Type C/D logic in JS, product_id can be null if it's a manual input? 
                  // "product_id: subheaderSelectEl?.value || null" in events.js line 1161.
                  // So product_id MUST BE NULLABLE for the new flexible design.
                  // I will make it nullable to support the unified pricing model where some items might be custom.
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
        Schema::dropIfExists('proposal_items');
    }
};
