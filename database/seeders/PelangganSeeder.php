<?php

namespace Database\Seeders;

use App\Models\Pelanggan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pelanggan::create([
            'NmPelanggan' => 'Adi Wijaya',
            'Username' => 'Adi',
            'Telpon' => '08980512312',
            'Sandi' => 'jayawijaya',
            'Alamat' => 'Jl Mastrip No 18',
            'Kota' => 'Jember'
        ]);
    }
}
