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
        Schema::table('engines', function (Blueprint $table) {
            $table->enum('fuel_type', ['petrol', 'diesel', 'electric', 'hybrid', 'plugin_hybrid', 'hydrogen', 'lpg', 'cng', 'other'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('engines', function (Blueprint $table) {
            //
        });
    }
};
