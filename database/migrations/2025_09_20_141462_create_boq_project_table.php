<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('boq_project', function (Blueprint $table) {
            $table->id();
            $table->foreignId('boq_id')->constrained()->onDelete('cascade');
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['boq_id', 'project_id']); // optional, prevent duplicates
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('boq_project');
    }
};
