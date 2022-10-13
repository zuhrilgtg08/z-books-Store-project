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
        
        $labels = ['Buku', 'Author', 'Penerbit'];
        $data = [
            $buku->count(), 
            $author->count(),
            $penerbit->count(),
            // $category->count(),
            // $users->count(),
            // $reviewsRating->count()
        ];
        
        return view('pages.admin.index', 
            compact('buku', 
                    'author', 
                    'penerbit', 
                    'labels',
                    'data',
                ));
    }
}
