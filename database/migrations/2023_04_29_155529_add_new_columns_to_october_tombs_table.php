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
            $table->string('name')->after('id');
            $table->string('type');
            $table->string('region');
            $table->date('last_burial');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('october_tombs', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('type');
            $table->dropColumn('region');
            $table->dropColumn('last_burial');
        });
    }
};
