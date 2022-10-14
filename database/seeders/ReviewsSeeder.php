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
            'id_buku' => 2,
            'id_user' => 1,
            'comments' => 'Ceritanya sangat menarik',
            'star_rating' => 4
        ]);

        ReviewRating::create([
            'id_buku' => 3,
            'id_user' => 1,
            'comments' => 'Ceritanya sangat bagus',
            'star_rating' => 5
        ]);
    }
}
