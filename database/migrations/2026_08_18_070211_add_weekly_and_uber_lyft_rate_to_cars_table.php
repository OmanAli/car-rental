<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->decimal('weekly_rate', 8, 2)->nullable()->after('rental_price_per_day');
            $table->decimal('uber_lyft_weekly_rate', 8, 2)->nullable()->after('weekly_rate');
        });
    }

    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn(['weekly_rate', 'uber_lyft_weekly_rate']);
        });
    }
};
