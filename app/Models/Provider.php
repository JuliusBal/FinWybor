<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Provider extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','slug','network','website_url','tracking_template','status',
    ];

    protected static function booted(): void
    {
        static::saving(function (Provider $provider) {
            if (empty($provider->slug) && ! empty($provider->name)) {
                $provider->slug = Str::slug($provider->name.'-'.Str::random(6));
            }
        });
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }
}
