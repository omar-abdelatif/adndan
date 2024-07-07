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
        Schema::create('tomb_donations_reports', function (Blueprint $table) {
            $table->id();
            $table->string('donator_name');
            $table->string('transaction_type');
            $table->bigInteger('invoice_no');
            $table->bigInteger('amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tomb_donations_reports');
    }
};
