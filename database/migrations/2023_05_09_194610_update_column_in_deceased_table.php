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
            $table->string('pdf_files', 255)->nullable()->after('files')->change();
            $table->string('files')->nullable()->after('notes')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('deceased', function (Blueprint $table) {
            //
        });
    }
};
