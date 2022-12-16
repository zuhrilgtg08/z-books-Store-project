<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ReviewRating;

class ReviewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ReviewRating::create([
            'id_buku' => 1,
            'id_user' => 2,
            'comments' => 'Ceritanya sangat bagus',
            'star_rating' => 4
        ]);
    }
}
