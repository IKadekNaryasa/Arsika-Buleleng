<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class KodeKlasifikasi extends Model
{
    use HasUuids;
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'kode',
        'keterangan',
    ];

    public function arsip()
    {
        return $this->hasMany(Arsip::class);
    }
}
