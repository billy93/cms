<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name', 255);
            $table->text('description')->nullable();
            $table->string('unit', 50);

            // Supplier (1:M)
            $table->foreignId('supplier_id')
                ->nullable()
                ->constrained('suppliers')
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['supplier_id']);
        }); 
        Schema::dropIfExists('products');
    }
};
