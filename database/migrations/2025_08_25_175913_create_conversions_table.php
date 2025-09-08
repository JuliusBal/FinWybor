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
        Schema::create('conversions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('click_id');
            $table->unsignedBigInteger('provider_id');
            $table->string('external_id', 128)->nullable();
            $table->enum('status', ['pending','approved','rejected'])->default('pending');
            $table->decimal('payout_amount', 10,2)->default(0.00);
            $table->char('currency', 3)->default('EUR');
            $table->timestamp('event_time')->nullable();
            $table->json('raw_payload')->nullable();
            $table->timestamps();

            $table->unique('click_id');
            $table->index('provider_id');
            $table->foreign('click_id')->references('id')->on('clicks');
            $table->foreign('provider_id')->references('id')->on('providers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversions');
    }
};
