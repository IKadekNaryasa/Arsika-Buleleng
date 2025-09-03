<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'kode_bidang',
        'nama_bidang'
    ];

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = Str::uuid()->toString();
            }
        });
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
