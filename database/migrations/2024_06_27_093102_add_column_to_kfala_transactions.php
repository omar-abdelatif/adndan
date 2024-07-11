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
            $table->string('donation_type')->after('transaction_type');
            $table->string('other_type')->after('donation_type')->nullable();
            $table->string('money_type')->after('other_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kfala_transactions', function (Blueprint $table) {
            $table->dropColumn('donation_type');
            $table->dropColumn('other_type');
            $table->dropColumn('money_type');
        });
    }
};
