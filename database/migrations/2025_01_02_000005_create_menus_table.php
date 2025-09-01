<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->string('path');
            $table->string('icon')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->integer('sort')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index('parent_id', 'idx_menus_parent_id');
            $table->index('is_active', 'idx_menus_is_active');
            $table->foreign('parent_id')->references('id')->on('menus')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};