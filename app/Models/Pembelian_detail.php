<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pembelian_detail extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pembelian_detail';

    protected $fillable = [
        'Pembelian_id',
        'Obat_id',
        'Jumlah',
    ];

    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class, 'Pembelian_id');
    }

    public function obat()
    {
        return $this->belongsTo(Obat::class, 'Obat_id');
    }
}
