<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Run the code082316
        DB::unprepared(file_get_contents(base_path('database/migrations/CECISTYLE.sql')));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
