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
        Schema::table('donators', function (Blueprint $table) {
            $table->string('name')->after('id');
            $table->bigInteger('mobile_phone')->after('name');
            $table->integer('amount')->after('mobile_phone');
            $table->string('duration')->after('amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donators', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('mobile_phone');
            $table->dropColumn('amount');
            $table->dropColumn('duration');
        });
    }
};
