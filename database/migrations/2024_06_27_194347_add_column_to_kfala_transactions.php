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
        Schema::table('kfala_transactions', function (Blueprint $table) {
            $table->bigInteger('invoice_no')->after('amount')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kfala_transactions', function (Blueprint $table) {
            $table->dropColumn('invoice_no');
        });
    }
};
