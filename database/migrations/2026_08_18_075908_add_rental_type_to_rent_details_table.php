<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rent_details', function (Blueprint $table) {
            $table->enum('rental_type', ['daily', 'weekly', 'uber_lyft_weekly'])->default('daily')->after('car_id');
        });
    }

    public function down(): void
    {
        Schema::table('rent_details', function (Blueprint $table) {
            $table->dropColumn('rental_type');
        });
    }
};
