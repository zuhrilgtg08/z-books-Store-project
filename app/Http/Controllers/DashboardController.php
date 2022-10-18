<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Author;
use App\Models\Category;
use App\Models\Penerbit;
use App\Models\User;
use App\Models\ReviewRating;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $reviewsRating = ReviewRating::all();
        $buku = Buku::all();
        $author = Author::all();
        $penerbit = Penerbit::all();
        $category = Category::all();
        $users = User::where('status_type', '<>', 1)->get();
        
        $labels1 = ['Buku', 'Author', 'Penerbit'];
        $labels2 = ['Rating', 'Categories', 'Users'];

        $data1 = [
            $buku->count(), 
            $author->count(),
            $penerbit->count(),
        ];

        $data2 = [
            $reviewsRating->count(),
            $category->count(),
            $users->count()
        ];
        
        return view('pages.admin.index', 
            compact(
                    'reviewsRating',
                    'buku', 
                    'author', 
                    'penerbit', 
                    'category',
                    'users',
                    'labels1',
                    'data1',
                    'labels2',
                    'data2',
                ));
    }
}
