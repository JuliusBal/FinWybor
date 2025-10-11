<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Subscriber extends Model
{
    protected $fillable = ['email','status','ip','user_agent','source','unsubscribed_at'];
    protected $casts   = ['unsubscribed_at' => 'datetime'];
    protected $guarded = ['token'];
    protected $hidden = ['token', 'ip', 'user_agent', 'source'];

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = mb_strtolower(trim($value));
    }
    protected static function booted(): void
    {
        static::creating(function (Subscriber $sub) {
            if (empty($sub->token)) {
                $sub->token = (string) Str::uuid();
            }
        });

        static::saving(function (Subscriber $sub) {
            if (empty($sub->token)) {
                $sub->token = (string) Str::uuid();
            }
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
    public function scopeEmail($q, string $email)
    {
        return $q->where('email', mb_strtolower(trim($email)));
    }
    public function resubscribe(): void
    {
        $this->forceFill([
            'status'          => 'subscribed',
            'unsubscribed_at' => null,
        ])->save();
    }

}
