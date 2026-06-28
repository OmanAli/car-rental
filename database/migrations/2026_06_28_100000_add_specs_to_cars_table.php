<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->unsignedTinyInteger('doors')->nullable()->after('year');
            $table->unsignedTinyInteger('passengers')->nullable()->after('doors');
            $table->string('transmission')->nullable()->after('passengers')->comment('Auto, Manual');
            $table->string('luggage')->nullable()->after('transmission')->comment('e.g. 2 Bags');
            $table->boolean('air_condition')->default(0)->after('luggage');
        });
    }

    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn(['doors', 'passengers', 'transmission', 'luggage', 'air_condition']);
        });
    }
};
