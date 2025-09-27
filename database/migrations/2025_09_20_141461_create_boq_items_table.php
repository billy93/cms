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
                  
            // Relasi ke produk (opsional) mengganti subheader
            $table->foreignId('product_id')
                  ->nullable()
                  ->constrained('products')
                  ->nullOnDelete();

            $table->string('header')->nullable();
            $table->string('subheader')->nullable(); // subheader is product name snapshot if it has relation to product 

            // Snapshot product (biar gak berubah kalau master berubah)
            $table->decimal('unit_price', 15, 2);

            // Title 1–4 (key = label, value = integer input)
            $table->string('title1_key')->nullable();
            $table->integer('title1_value')->nullable();

            $table->string('title2_key')->nullable();
            $table->integer('title2_value')->nullable();

            $table->string('title3_key')->nullable();
            $table->integer('title3_value')->nullable();

            $table->string('title4_key')->nullable();
            $table->integer('title4_value')->nullable();

            // Detail perhitungan
            $table->decimal('multiplier_total', 15, 2);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('boq_items');
    }
};
