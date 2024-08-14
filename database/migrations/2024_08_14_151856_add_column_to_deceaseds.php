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
        Schema::table('deceaseds', function (Blueprint $table) {
            $table->integer('tombs_id')->index()->references('id')->on('tombs')->onDelete('cascade')->after('rooms_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('deceaseds', function (Blueprint $table) {
            $table->dropColumn('tombs_id');
        });
    }
};
