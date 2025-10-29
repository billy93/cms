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

            // Jenis form
            $table->enum('form_type', ['A', 'B', 'C', 'D'])
                  ->default('A');

            // Deskripsi umum BOQ
            $table->text('description')->nullable();
            $table->decimal('total_amount_items', 15, 2)->nullable();

            // Summary pricing
            $table->decimal('management_fee', 15, 2)->nullable();
            $table->enum('management_fee_type', ['percent', 'nominal'])->default('percent');

            $table->decimal('sales_amount', 15, 2)->nullable();

            $table->decimal('vat', 15, 2)->nullable();
            $table->tinyInteger('vat_rate')->nullable();
             
            $table->decimal('invoice_amount', 15, 2)->nullable();

            $table->timestamps();
        });

        DB::statement('ALTER TABLE boqs ADD CONSTRAINT chk_vat_rate CHECK (vat_rate IN (1, 11))');
    }


    public function down(): void
    {
        Schema::dropIfExists('boqs');
    }
};
