<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_price_versions', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('product_id')
                  ->constrained('products')
                  ->cascadeOnDelete();
            
            $table->integer('version')->default(1); // Auto-increment per product
            
            // Only price is versioned
            $table->decimal('price', 15, 2)->default(0);
            
            // Version status
            $table->boolean('is_active')->default(true);
            $table->timestamp('effective_from')->useCurrent();
            $table->timestamp('effective_until')->nullable();
            
            $table->timestamps();
            
            // Indexes
            $table->unique(['product_id', 'version']); // Ensure unique version per product
            $table->index(['product_id', 'is_active']); // Fast lookup for active version
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_price_versions');
    }
};
