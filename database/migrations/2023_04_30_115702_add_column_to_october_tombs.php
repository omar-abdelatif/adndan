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
        Schema::table('october_tombs', function (Blueprint $table) {
            $table->integer('power')->after('type');
            $table->string('annually_cost')->after('burial_cost');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('october_tombs', function (Blueprint $table) {
            $table->dropColumn('power');
            $table->dropColumn('annually_cost');
        });
    }
};
