<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Province::create([
            'name_province' => 'Bali',
        ]);

        Province::create([
            'name_province' => 'Bangka Belitung',
        ]);

        Province::create([
            'name_province' => 'Banten',
        ]);

        Province::create([
            'name_province' => 'Bengkulu',
        ]);

        Province::create([
            'name_province' => 'DI Yogyakarta',
        ]);

        Province::create([
            'name_province' => 'DKI Jakarta',
        ]);

        Province::create([
            'name_province' => 'Gorontalo',
        ]);

        Province::create([
            'name_province' => 'Jambi',
        ]);

        Province::create([
            'name_province' => 'Jawa Barat',
        ]);

        Province::create([
            'name_province' => 'Jawa Tengah',
        ]);

        Province::create([
            'name_province' => 'Jawa Timur',
        ]);

        Province::create([
            'name_province' => 'Kalimantan Barat',
        ]);

        Province::create([
            'name_province' => 'Kalimantan Selatan',
        ]);

        Province::create([
            'name_province' => 'Kalimantan Tengah',
        ]);

        Province::create([
            'name_province' => 'Kalimantan Timur',
        ]);

        Province::create([
            'name_province' => 'Kalimantan Utara',
        ]);

        Province::create([
            'name_province' => 'Kepulauan Riau',
        ]);

        Province::create([
            'name_province' => 'Lampung',
        ]);

        Province::create([
            'name_province' => 'Maluku',
        ]);

        Province::create([
            'name_province' => 'Maluku Utara',
        ]);

        Province::create([
            'name_province' => 'Nanggroe Aceh Darussalam (NAD)',
        ]);

        Province::create([
            'name_province' => 'Nusa Tenggara Barat (NTB)',
        ]);

        Province::create([
            'name_province' => 'Nusa Tenggara Timur (NTT)',
        ]);

        Province::create([
            'name_province' => 'Papua',
        ]);

        Province::create([
            'name_province' => 'Papua Barat',
        ]);

        Province::create([
            'name_province' => 'Riau',
        ]);

        Province::create([
            'name_province' => 'Sulawesi Barat',
        ]);

        Province::create([
            'name_province' => 'Sulawesi Selatan',
        ]);

        Province::create([
            'name_province' => 'Sulawesi Tengah',
        ]);

        Province::create([
            'name_province' => 'Sulawesi Tenggara',
        ]);

        Province::create([
            'name_province' => 'Sulawesi Utara',
        ]);

        Province::create([
            'name_province' => 'Sumatera Barat',
        ]);

        Province::create([
            'name_province' => 'Sumatera Selatan',
        ]);

        Province::create([
            'name_province' => 'Sumatera Utara',
        ]);
    }
}
