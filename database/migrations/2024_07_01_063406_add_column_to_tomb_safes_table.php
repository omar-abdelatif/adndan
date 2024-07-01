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
        Schema::table('tomb_safes', function (Blueprint $table) {
            $table->string('transaction_type')->after('id');
            $table->bigInteger('amount')->default(0)->after('transaction_type');
            $table->string('proof_img')->after('amount')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tomb_safes', function (Blueprint $table) {
            $table->dropColumn('transaction_type');
            $table->dropColumn('amount');
            $table->dropColumn('proof_img');
        });
    }
};
