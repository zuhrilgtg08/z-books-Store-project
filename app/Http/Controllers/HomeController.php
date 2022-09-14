<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Author;
use App\Models\Category;
use App\Models\Penerbit;
use App\Models\ReviewRating;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $tag = '';
        if (request('category')) {
            $category = Category::firstWhere('slug', request('category'));
            $tag = ' category: ' . $category->name;
        }

        if(request('penerbit')) {
            $penerbit = Penerbit::firstWhere('slug', request('penerbit'));
            $tag = ' penerbit: ' . $penerbit->nama_penerbit;
        }

        if (request('author')) {
            $author = Author::firstWhere('slug', request('author'));
            $tag = ' By: ' . $author->nama_author;
        }

        return view('pages.home', [
            "tag" => $tag,
            "data" => Buku::latest()->filter(request(['search', 'category', 'penerbit', 'author']))->paginate(9)->withQueryString()
        ]);
    }

    public function info($id)
    {
        $idBuku = Buku::findOrFail($id);
        return view('pages.homeInfoBuku', [
            "info" => $idBuku
        ]);
    }

    public function reviewStore(Request $request)
    {
        $review = new ReviewRating();
        $review->buku_id = $request->buku_id;
        $review->name = $request->name;
        $review->email = $request->email;
        $review->number_phone = $request->number_phone;
        $review->comments = $request->comment;
        $review->star_rating = $request->rating;
        $review->save();

        return redirect()->back()->with('success', 'Your review has been submitted Successfully,');
    }
}
