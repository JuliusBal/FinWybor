<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FinanceDemoSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        $awin = DB::table('providers')->insertGetId([
            'name' => 'Awin Demo',
            'network' => 'awin',
            'website_url' => 'https://www.awin.com',
            'tracking_template' => 'https://track.awin.com/click?mid=1234&subid={CLICK_ID}&amount={AMOUNT}&term={TERM}',
            'status' => 'active',
            'created_at' => $now, 'updated_at' => $now
        ]);

        $admitad = DB::table('providers')->insertGetId([
            'name' => 'Admitad Demo',
            'network' => 'admitad',
            'website_url' => 'https://www.admitad.com',
            'tracking_template' => 'https://ad.admitad.com/g/xyz/?subid={SUBID}',
            'status' => 'active',
            'created_at' => $now, 'updated_at' => $now
        ]);

        // Loan
        DB::table('offers')->insert([
            'provider_id' => $awin,
            'offer_code' => 'LOAN123',
            'brand' => 'PożyczkaX',
            'product_type' => 'loan',
            'currency' => 'PLN',
            'rrso' => 78.900,
            'amount_min' => 300,
            'amount_max' => 5000,
            'term_min_months' => 1,
            'term_max_months' => 12,
            'interest_type' => 'annuity',
            'monthly_rate' => 0.035,
            'setup_fee' => 0,
            'bik_check' => true,
            'payout_speed' => 'same_day',
            'first_loan_free' => false,
            'eligibility_notes' => '18+ obywatel PL; stały dochód',
            'tracking_url' => 'https://track.awin.com/click?mid=1234&subid={CLICK_ID}&amount={AMOUNT}&term={TERM}',
            'status' => 'active',
            'source' => 'demo',
            'created_at' => $now, 'updated_at' => $now
        ]);

        // Credit card
        DB::table('offers')->insert([
            'provider_id' => $admitad,
            'offer_code' => 'CARD777',
            'brand' => 'KartaPlus',
            'product_type' => 'card',
            'currency' => 'PLN',
            'annual_fee' => 120.00,
            'grace_days' => 54,
            'cashback_pct' => 1.5,
            'welcome_bonus' => '200 PLN premii po wydaniu 1000 PLN',
            'tracking_url' => 'https://ad.admitad.com/g/xyz/?subid={SUBID}',
            'status' => 'active',
            'source' => 'demo',
            'created_at' => $now, 'updated_at' => $now
        ]);

        // Insurance
        DB::table('offers')->insert([
            'provider_id' => $admitad,
            'offer_code' => 'INSOC001',
            'brand' => 'UbezpieczAuto (Aggregator)',
            'product_type' => 'insurance',
            'currency' => 'PLN',
            'insurance_kind' => 'oc',
            'premium_from' => 350.00,
            'tracking_url' => 'https://ad.admitad.com/g/abc/?subid={SUBID}',
            'status' => 'active',
            'source' => 'demo',
            'created_at' => $now, 'updated_at' => $now
        ]);
    }
}
