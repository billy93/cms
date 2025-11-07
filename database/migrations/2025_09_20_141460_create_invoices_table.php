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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();

            // FK ke Proposal (invoice wajib terkait proposal)
            $table->foreignId('proposal_id')
                ->constrained('proposals')
                ->cascadeOnDelete();

            // Optional FK ke Customer (ambil dari project via proposal)
            $table->foreignId('customer_id')
                ->nullable()
                ->constrained('customers')
                ->nullOnDelete();

            // Nomor invoice internal
            $table->string('code')->unique();

            // Tanggal invoice & jatuh tempo
            $table->date('invoice_date');
            $table->date('due_date');

            // Status pembayaran
            $table->enum('status', ['Unpaid','Paid','Cancelled'])->default('Unpaid');

            // Type invoice (partial / full)
            $table->enum('type', ['Full','Partial'])->default('Full');

            // Payment info
            $table->string('payment_method')->nullable();

            // Alamat / informasi billing
            $table->string('bill_to')->nullable();
            $table->string('ship_to')->nullable();

            // Financial summary
            $table->decimal('total_amount', 15, 2)->default(0);

            // Notes & terms
            $table->text('note')->nullable();
            $table->text('terms_and_conditions')->nullable();

            // Signature
            $table->string('signature_name')->nullable();
            $table->string('signature_image')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
