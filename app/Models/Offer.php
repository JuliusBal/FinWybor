<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'provider_id','offer_code','brand','product_type','currency','rrso',
        'amount_min','amount_max','term_min_months','term_max_months',
        'interest_type','monthly_rate','setup_fee','bik_check','payout_speed',
        'first_loan_free','eligibility_notes',
        'annual_fee','grace_days','cashback_pct','welcome_bonus',
        'insurance_kind','premium_from',
        'tracking_url','status','source'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }
}
