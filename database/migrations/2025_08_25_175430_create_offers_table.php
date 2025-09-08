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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('provider_id');
            $table->string('offer_code', 100)->nullable();
            $table->string('brand', 120);
            $table->enum('product_type', ['loan','card','insurance']);
            $table->char('currency',3)->default('PLN');
            $table->decimal('rrso', 7,3)->nullable();

            $table->unsignedInteger('amount_min')->default(100);
            $table->unsignedInteger('amount_max')->default(5000);
            $table->unsignedSmallInteger('term_min_months')->default(1);
            $table->unsignedSmallInteger('term_max_months')->default(12);
            $table->enum('interest_type', ['annuity','flat','promo_zero','other'])->default('annuity');
            $table->decimal('monthly_rate', 7,5)->nullable();
            $table->decimal('setup_fee', 10,2)->nullable();
            $table->boolean('bik_check')->default(true);
            $table->enum('payout_speed', ['instant','same_day','1_3_days','other'])->nullable();
            $table->boolean('first_loan_free')->default(false);
            $table->string('eligibility_notes', 512)->nullable();

            $table->decimal('annual_fee', 10,2)->nullable();
            $table->unsignedSmallInteger('grace_days')->nullable();
            $table->decimal('cashback_pct', 5,2)->nullable();
            $table->string('welcome_bonus', 255)->nullable();

            $table->enum('insurance_kind', ['oc','ac','travel','health','property','other'])->nullable();
            $table->decimal('premium_from', 10,2)->nullable();

            $table->string('tracking_url', 1024)->nullable();
            $table->enum('status', ['active','hidden','archived'])->default('active');
            $table->string('source', 50)->nullable();
            $table->timestamps();

            $table->index(['provider_id']);
            $table->index(['product_type']);
            $table->index(['amount_min','amount_max']);
            $table->index(['term_min_months','term_max_months']);
            $table->foreign('provider_id')->references('id')->on('providers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
