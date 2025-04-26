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
        Schema::create('invoice', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->string('bill_to');
            $table->string('ship_to');
            $table->unsignedBigInteger('project_id')->nullable();
            $table->decimal('amount', 15, 2);
            $table->string('currency', 10);
            $table->date('invoice_date');
            $table->date('due_date');
            $table->string('payment_method')->nullable();
            $table->string('status')->nullable();
            $table->text('description');
            $table->string('signature_name')->nullable();
            $table->string('signature_image')->nullable();
            $table->text('notes');
            $table->text('terms_and_conditions');
            $table->decimal('subtotal', 15, 2)->default(0);
            $table->decimal('discount', 5, 2)->default(0);
            $table->decimal('extra_discount', 5, 2)->default(0);
            $table->decimal('tax', 15, 2)->default(0);
            $table->decimal('total', 15, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice');
    }
};
