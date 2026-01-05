<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('boqs', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();

            // Foreign key ke Proposal
            $table->foreignId('proposal_id')
                  ->nullable()       
                  ->constrained('proposals')
                  ->cascadeOnDelete();

            $table->foreignId('invoice_id')
                ->nullable()
                ->constrained('invoices')
                ->nullOnDelete();
                  
            $table->decimal('total_amount_items', 15, 2)->nullable();

            // Header grouping for Type B pricing model
            $table->string('header')->nullable();
            $table->string('subheader')->nullable();
            $table->integer('header_order')->default(0);

            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('boqs');
    }
};
