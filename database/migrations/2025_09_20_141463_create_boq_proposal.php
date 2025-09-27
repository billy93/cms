<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('boq_proposal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('boq_id')->constrained()->onDelete('cascade');
            $table->foreignId('proposal_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['boq_id', 'proposal_id']); // optional
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('boq_proposal');
    }
};
