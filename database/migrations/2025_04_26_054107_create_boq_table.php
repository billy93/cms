<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel boqs
        Schema::create('boqs', function (Blueprint $table) {
            $table->id();
            $table->string('boq_type'); // A, B, C, D, E
            $table->string('customer_name')->nullable();
            $table->string('sales_code')->nullable(); // Awalnya null
            $table->timestamps();
        });

        // Tabel boq_titles
        Schema::create('boq_titles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('boq_id')->constrained('boqs')->onDelete('cascade');
            $table->string('title_name');
            $table->integer('position')->comment('1, 2, 3, dst untuk urutan title');
            $table->timestamps();
        });

        // Tabel boq_items
        Schema::create('boq_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('boq_id')->constrained('boqs')->onDelete('cascade');
            $table->string('product_name');
            $table->text('description')->nullable();
            $table->string('pricing_model')->nullable(); // Misal "Manual Entry", "Perhitungan sistem"
            $table->decimal('sales_amount', 15, 2)->nullable();
            $table->timestamps();
        });

        // Tabel boq_item_prices
        Schema::create('boq_item_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('boq_item_id')->constrained('boq_items')->onDelete('cascade');
            $table->foreignId('boq_title_id')->constrained('boq_titles')->onDelete('cascade');
            $table->decimal('amount', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('boq_item_prices');
        Schema::dropIfExists('boq_items');
        Schema::dropIfExists('boq_titles');
        Schema::dropIfExists('boqs');
    }
};
