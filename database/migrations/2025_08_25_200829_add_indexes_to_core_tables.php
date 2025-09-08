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
        Schema::table('offers', function (Blueprint $table) {
            $table->index(['product_type', 'status'], 'offers_type_status_idx');
            $table->index(['amount_min', 'amount_max'], 'offers_amount_range_idx');
            $table->index(['term_min_months', 'term_max_months'], 'offers_term_range_idx');
            $table->index('payout_speed', 'offers_payout_speed_idx');
        });

        Schema::table('clicks', function (Blueprint $table) {
            $table->index(['offer_id', 'created_at'], 'clicks_offer_created_idx');
            $table->unique('click_uuid', 'clicks_uuid_unique');
        });

        Schema::table('conversions', function (Blueprint $table) {
            $table->unique(['provider_id', 'external_id'], 'conversions_provider_extid_unique');
            $table->index(['status', 'created_at'], 'conversions_status_created_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->dropIndex('offers_type_status_idx');
            $table->dropIndex('offers_amount_range_idx');
            $table->dropIndex('offers_term_range_idx');
            $table->dropIndex('offers_payout_speed_idx');
        });

        Schema::table('clicks', function (Blueprint $table) {
            $table->dropIndex('clicks_offer_created_idx');
            $table->dropUnique('clicks_uuid_unique');
        });

        Schema::table('conversions', function (Blueprint $table) {
            $table->dropUnique('conversions_provider_extid_unique');
            $table->dropIndex('conversions_status_created_idx');
        });
    }
};
