<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('boq_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('boq_id')
                  ->constrained('boqs')
                  ->cascadeOnDelete();
                  
            $table->foreignId('product_id')
                  ->constrained('products')
                  ->cascadeOnDelete();
            
            $table->foreignId('product_price_version_id')
                  ->nullable()
                  ->constrained('product_price_versions')
                  ->nullOnDelete();
            
            // Snapshot data
            $table->text('description')->nullable();
            $table->decimal('selling_price', 15, 2);
            
            $table->integer('qty')->default(1);
            $table->string('qty_unit')->nullable(); // e.g., pckg, unit

            $table->integer('freq')->default(1);
            $table->string('freq_unit')->nullable(); // e.g., event, day

            $table->decimal('total_price', 15, 2);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('boq_items');
    }
};
