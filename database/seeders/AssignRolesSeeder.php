<?php

namespace Database\Seeders;

use App\Models\Pelanggan;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AssignRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::find(1);
        $adminRole = Role::where('name', 'Admin')->first();
        $admin->assignRole($adminRole);

        $pelanggan = Pelanggan::find(1);
        $pelangganRole = Role::where('name', 'Pelanggan')->first();
        $pelanggan->assignRole($pelangganRole);
    }
}
