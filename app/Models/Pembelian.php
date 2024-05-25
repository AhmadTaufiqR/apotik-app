<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pembelian extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pembelian';
    
    protected $fillable = [
        'TglNota',
        'Suplier_id',
        'diskon',
    ];

    public function suplier()
    {
        return $this->belongsTo(Suplier::class, 'Suplier_id');
    }
}
