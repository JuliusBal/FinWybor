<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversion extends Model
{
    protected $fillable = [
        'click_id',
        'provider_id',
        'external_id',
        'status',
        'payout_amount',
        'currency',
        'event_time',
        'raw_payload',
    ];

    protected $casts = [
        'payout_amount' => 'decimal:2',
        'event_time'    => 'datetime',
        'raw_payload'   => 'array',
    ];

    public function click()
    {
        return $this->belongsTo(Click::class);
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }
}
