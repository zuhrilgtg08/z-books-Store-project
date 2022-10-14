<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\User;
use App\Models\Author;
use App\Models\Category;
use App\Models\Penerbit;
use App\Models\ReviewRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function info($id, Request $request)
    {
        $idBuku = Buku::findOrFail($id);
        $reviews = ReviewRating::where([
                        ['id_buku', '=', $id],
                        ['id_user', Auth::user()->id]
                    ])->get();

        return view('pages.homeInfoBuku', [
            "info" => $idBuku,
            "reviews" => $reviews
        ]);
    }

    public function reviewRating(Request $request)
    {
        $reviews = ReviewRating::where('id_user', Auth::user()->id)
                                ->where('id_buku', $request->id_buku)->first();

        if($reviews !== null) {
            $reviews->update([
                'comments' => $request->comment,
                'star_rating' => $request->rating
            ]);
            return redirect()->back()->with('success', 'Your review has been Updated');
        } else {
            $reviews = ReviewRating::create([
                'id_buku' => $request->id_buku,
                'id_user' => Auth::user()->id,
                'comments' => $request->comment,
                'star_rating' => $request->rating
            ]);

            return redirect()->back()->with('success', 'Your review has been submitted Successfully');
        }
    }
}
