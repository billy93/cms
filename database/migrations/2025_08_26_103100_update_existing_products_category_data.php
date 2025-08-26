<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, add category_id column as nullable
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable()->after('base_cost');
        });

        // Map existing enum values to category IDs
        $categoryMappings = [
            'RAW_MATERIAL' => 1,
            'FINISHED_GOODS' => 2, 
            'SERVICE' => 3
        ];

        // Update existing products with category_id based on category enum
        foreach ($categoryMappings as $enumValue => $categoryId) {
            DB::table('products')
                ->where('category', $enumValue)
                ->update(['category_id' => $categoryId]);
        }

        // Set default category_id for any null values (fallback to first category)
        DB::table('products')
            ->whereNull('category_id')
            ->update(['category_id' => 1]);

        // Make category_id not nullable
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('category_id');
        });
    }
};
