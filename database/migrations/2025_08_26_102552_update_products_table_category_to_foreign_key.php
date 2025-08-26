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
        Schema::table('products', function (Blueprint $table) {
            // Add foreign key constraint (category_id column already exists)
            $table->foreign('category_id')
                  ->references('id')
                  ->on('product_categories')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
                  
            // Add index for better performance
            $table->index('category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Drop foreign key constraint and index
            $table->dropForeign(['category_id']);
            $table->dropIndex(['category_id']);
            $table->dropColumn('category_id');
            
            // Restore the enum column
            $table->enum('category', ['RAW_MATERIAL', 'FINISHED_GOODS', 'SERVICE'])->after('base_cost');
        });
    }
};
