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
        Schema::create('clicks', function (Blueprint $table) {
            $table->id();
            $table->char('click_uuid', 36);
            $table->unsignedBigInteger('offer_id');
            $table->unsignedBigInteger('provider_id');
            $table->unsignedInteger('amount')->nullable();
            $table->unsignedSmallInteger('term_months')->nullable();
            $table->string('user_agent', 512)->nullable();
            $table->char('ip_hash', 64)->nullable();
            $table->string('referer', 512)->nullable();
            $table->timestamps();

            $table->index('click_uuid');
            $table->index('offer_id');
            $table->foreign('offer_id')->references('id')->on('offers');
            $table->foreign('provider_id')->references('id')->on('providers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clicks');
    }
};
