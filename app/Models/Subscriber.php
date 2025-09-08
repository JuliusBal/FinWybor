<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Subscriber extends Model
{
    protected $fillable = ['email','status','ip','user_agent','source','token','unsubscribed_at'];
    protected $casts   = ['unsubscribed_at' => 'datetime'];

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = mb_strtolower(trim($value));
    }

    protected static function booted()
    {
        static::creating(function ($sub) {
            if (empty($sub->token)) $sub->token = (string) Str::uuid();
        });
    }

    public function scopeSubscribed($q)
    {
        return $q->whereNull('unsubscribed_at')->where('status','subscribed');
    }
    public function isActive(): bool
    {
        return is_null($this->unsubscribed_at) && $this->status === 'subscribed';
    }
}
