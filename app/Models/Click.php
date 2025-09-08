<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Click extends Model
{
    use HasFactory;

    protected $fillable = [
        'click_uuid','offer_id','provider_id','amount','term_months',
        'user_agent','ip_hash','referer'
    ];
}
