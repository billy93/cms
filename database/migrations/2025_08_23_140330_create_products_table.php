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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('unit', 32);
            $table->double('base_cost');
            $table->unsignedBigInteger('category_id'); // FK ke product_categories
            $table->unsignedBigInteger('supplier_id');
            $table->timestamps();

            // Index & FK
            $table->index('supplier_id', 'idx_products_supplier_id');
            $table->foreign('supplier_id', 'fk_products_supplier')
                  ->references('id')->on('suppliers')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');

            $table->index('category_id', 'idx_products_category_id');
            $table->foreign('category_id', 'fk_products_category')
                  ->references('id')->on('product_categories')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
