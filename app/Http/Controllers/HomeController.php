<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\User;
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
        $reviews = ReviewRating::where([
                        ['id_buku', '=', $id],
                    ])->get();

        return view('pages.homeInfoBuku', [
            "info" => $idBuku,
            "reviews" => $reviews
        ]);
    }

    public function review($id)
    {
        $user_id = User::findOrFail($id);
        return view('pages.homeRatingBuku', compact('user_id'));
    }

    public function reviewStore(Request $request)
    {
        // $review = $request->validate([
        //     'name' => 'required|max:255',
        //     'email' => 'required|email',
        //     'number_phone' => 'numeric',
        //     'comments' => 'required',
        //     'star_rating' => 'required'
        // ]);

        // $validateData = [
        //     'user_id' => $request->user_id,
        //     'id_buku' => $request->id_buku,
        //     'comments' => $request->comments,
        //     'star_rating' => $request->rating
        // ];
        $review = new ReviewRating();
        $review->id_buku = $request->id_buku;
        $review->name = $request->name;
        $review->email = $request->email;
        $review->number_phone = auth()->user()->number_phone;
        $review->comments = $request->comment;
        $review->star_rating = $request->rating;
        $review->save();
        // $review = ReviewRating::create($validateData);
        // return redirect()->back()->with('success', 'Your review has been submitted Successfully,', compact('review'));
        return redirect()->back()->with('success', 'Your review has been submitted Successfully');
    }

    // public function readReview()
    // {
    //     $reviews = ReviewRating::all();
    //     dd($reviews);
    //     // return view('pages.homeInfoBuku', compact('review'));
    // }
}
