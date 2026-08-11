<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rent_details', function (Blueprint $table) {
            $table->foreignId('veteran_discount_id')->nullable()->after('coupon_id')->constrained('veteran_discounts')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('rent_details', function (Blueprint $table) {
            $table->dropForeign(['veteran_discount_id']);
            $table->dropColumn('veteran_discount_id');
        });
    }
};
