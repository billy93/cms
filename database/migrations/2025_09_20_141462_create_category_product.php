<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('category_product', function (Blueprint $table) {
            $table->id();

            $table->foreignId('product_id')
                ->constrained('products')
                ->onUpdate('cascade')
                ->onDelete('cascade'); // kalau product dihapus, pivot juga hilang

            $table->foreignId('category_id')
                ->constrained('product_categories')
                ->onUpdate('cascade')
                ->onDelete('cascade'); // kalau category dihapus, pivot juga hilang

            $table->timestamps();

            $table->unique(['product_id', 'category_id'], 'unique_product_category');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('category_product');
    }
};
