<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
            'name' => 'admin2022',
            'email' => 'admin2022@gmail.com',
            'password' => bcrypt('admin2022'),
            'image' => NULL,
            'alamat' => "Jl ABC No. 123",
            'number_phone' => "123456789011",
            'status_type' => 1,
        ]);

        User::create([
            'name' => 'user123',
            'email' => 'user123@gmail.com',
            'password' => bcrypt('user123'),
            'image' => NULL,
            'alamat' => "Jl ABC No. 456",
            'number_phone' => "123456789011",
            'status_type' => 0,
        ]);
    }
}
