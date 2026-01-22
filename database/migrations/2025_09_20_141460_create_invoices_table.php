<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();

            $table->foreignId('project_id')
                ->nullable()
                ->constrained('projects')
                ->cascadeOnDelete();

            $table->foreignId('proposal_id')
                ->nullable()
                ->constrained('proposals')
                ->cascadeOnDelete();

            $table->foreignId('customer_id')
                ->nullable()
                ->constrained('customers')
                ->cascadeOnDelete();

            $table->string('code')->unique();

            $table->date('invoice_date');
            $table->date('due_date');
            $table->text('description')->nullable();

            $table->enum('status', ['Unpaid','Paid','Cancelled'])->default('Unpaid');
            $table->enum('type', ['Full','Partial'])->default('Full');
            $table->string('payment_method')->nullable();
            $table->string('bill_to')->nullable();
            $table->string('ship_to')->nullable();

            $table->decimal('total_amount', 15, 2);
            $table->enum('management_fee_type', ['nominal', 'percent'])->default('percent');
            $table->decimal('management_fee', 15, 2)->default(0);
            $table->integer('vat_rate')->default(11);

            $table->text('note')->nullable();
            $table->text('terms_and_conditions')->nullable();

            $table->string('signature_name')->nullable();
            $table->string('signature_image')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
