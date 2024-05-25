<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Pelanggan extends Model
{
    use HasRoles, HasFactory, SoftDeletes;


    protected $table = 'pelanggan';

    protected $guard_name = 'web';

    protected $fillable = [
        'NmPelanggan',
        'email',
        'Telpon',
        'password',
        'Alamat',
        'Kota'
    ];
}
