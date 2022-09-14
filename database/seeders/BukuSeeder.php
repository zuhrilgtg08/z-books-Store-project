<?php

namespace Database\Seeders;

use App\Models\Buku;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Buku::create([
            'kode_buku' => 'D0001',
            'judul_buku' => 'Default Books',
            'harga' => 150000,
            'stok' => 3,
            'category_id' => 1,
            'author_id' => 1,
            'penerbit_id' => 2,
            'image' => Null,
            'sinopsis' => 'Lacinia ad ipsum ligula lectus est nisl vivamus...',
            'excerpt' => 'Lacinia ad ipsum ligula lectus est nisl vivamus. Venenatis luctus adipiscing est cursus penatibus finibus cras efficitur. Facilisi mi penatibus quisque mattis himenaeos. Tortor gravida pede quis accumsan eu vehicula netus semper. Fames metus gravida etiam bibendum amet. Nibh ultrices si auctor lectus potenti.'
        ]);
    }
}
