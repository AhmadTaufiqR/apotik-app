<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Obat extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'obat';

    protected $fillable = [
        'NmObat',
        'Jenis',
        'Satuan',
        'HargaBeli',
        'HargaJual',
        'Stok',
        'kadaluarsa',
        'Suplier_id'
    ];

    public function suplier()
    {
        return $this->belongsTo(Suplier::class, 'suplier_id');
    }
}
