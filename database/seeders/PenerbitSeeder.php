<?php

namespace Database\Seeders;

use App\Models\Penerbit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenerbitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Penerbit::create([
            'kode_terbit' => 'E000001',
            'nama_penerbit' => 'Erlangga',
            'slug' => 'erlangga',
            'tahun_terbit' => 1999
        ]);

        Penerbit::create([
            'kode_terbit' => 'G000001',
            'nama_penerbit' => 'Gramedia',
            'slug' => 'gramedia',
            'tahun_terbit' => 2000
        ]);

        Penerbit::create([
            'kode_terbit' => 'S000001',
            'nama_penerbit' => 'Shueisha',
            'slug' => 'shueisha',
            'tahun_terbit' => 1949
        ]);
    }
}
