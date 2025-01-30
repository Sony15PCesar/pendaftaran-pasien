<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nama' => 'Admin',
            'email' => 'admin@sakinaidaman.com',
            'password' => Hash::make('1234'),
            'role' => 'admin', 
        ]);

        User::create([
            'nama' => 'Pegawai',
            'email' => 'pegawai@sakinaidaman.com',
            'password' => Hash::make('1234'),
            'role' => 'pegawai',
        ]);
    }
}
