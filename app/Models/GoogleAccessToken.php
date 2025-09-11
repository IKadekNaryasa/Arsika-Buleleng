<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoogleAccessToken extends Model
{
    protected $table = 'google_access_tokens';

    protected $fillable = [
        'access_token',
        'expires_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];
}
