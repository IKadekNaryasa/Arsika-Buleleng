<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Arsip extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'kode_arsip',
        'kategori',
        'klasifikasi_id',
        'tanggal_arsip',
        'nama_file',
        'uraian',
        'path_file',
        'status_legalisasi',
        'user_id',
        'type',
        'nomor_dokumen',
        'masa_aktif'
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
        return $this->belongsTo(User::class);
    }

    public function kodeKlasifikasi()
    {
        return $this->belongsTo(KodeKlasifikasi::class, 'klasifikasi_id');
    }
}
