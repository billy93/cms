<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained('menus')->nullOnDelete();
            $table->string('name', 100);
            $table->string('icon', 100)->nullable();
            // $table->string('route_name',  150)->nullable(); // ex: "projects.index"
            $table->foreignId('permission_id')->nullable()->constrained('permissions')->nullOnDelete();
            $table->integer('order_index')->default(0);
            $table->boolean('is_visible')->default(true);
            $table->timestamps();

            $table->index(['parent_id']);
            // $table->index(['parent_id', 'route_name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
