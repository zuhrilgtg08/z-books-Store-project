<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Novel',
            'slug' => 'novel'
        ]);

        Category::create([
            'name' => 'Teknologi Digital',
            'slug' => 'teknologi-digital'
        ]);

        Category::create([
            'name' => 'Komik',
            'slug' => 'komik'
        ]);

        Category::create([
            'name' => 'Biografi',
            'slug' => 'biografi'
        ]);
    }
}
