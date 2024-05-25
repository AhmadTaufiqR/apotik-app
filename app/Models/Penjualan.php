<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penjualan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'penjualan';

    protected $fillable = [
        'TglNota',
        'Pelanggan_id',
        'diskon',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'Pelanggan_id');
    }
}
