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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount',10,2);
            $table->unsignedBigInteger('payer');
            $table->date('due_on');
            $table->decimal('vat',10,2);
            $table->boolean('is_vat_inclusive');
            $table->string('status')->default('Outstanding');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('payer')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
