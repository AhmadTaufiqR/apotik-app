<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penjualan_detail extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'penjualan_detail';

    protected $fillable = [
        'Penjualan_id',
        'Obat_id',
        'Jumlah',
    ];

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'Penjualan_id');
    }

    public function obat()
    {
        return $this->belongsTo(Obat::class, 'Obat_id');
    }
}
