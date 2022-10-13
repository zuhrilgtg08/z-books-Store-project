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
                    ])->get();
        // $reviews = ReviewRating::where([
        //     'id_user', '=', Auth::user()->id,
        //     'id_buku', '=', $id
        // ])->first();
        // dd($reviews);
        return view('pages.homeInfoBuku', [
            "info" => $idBuku,
            "reviews" => $reviews
        ]);
    }

    public function reviewRating(Request $request)
    {
        $reviews = ReviewRating::where('id_user', auth()->user()->id)->where('id_buku', $request->id_buku)->first();
        // $reviews = ReviewRating::where([
        //     'id_user', '=', Auth::user()->id,
        //     'id_buku', '=', $request->id_buku
        // ])->first();

        if($reviews == null) {
            $reviews = ReviewRating::create([
                'name' => $request->name,
                'email' => $request->email,
                'number_phone' => $request->number_phone,
                'id_buku' => $request->id_buku,
                'id_user' => $request->id_user,
                'comments' => $request->comment,
                'star_rating' => $request->rating
            ]);
            $reviews->save();
            return redirect()->back()->with('success', 'Your review has been submitted Successfully');
        } else {
            $reviews->update([
                'star_rating' => $request->rating,
                'comments' => $request->comment
            ]);
            // return $request->all();
            return redirect()->back()->with('success', 'Your review has been Updated');
        }
    }
}






//untuk pembelajaran
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
    // $review = ReviewRating::create($validateData);
        // return redirect()->back()->with('success', 'Your review has been submitted Successfully,', compact('review'));
            // public function readReview()
    // {
    //     $reviews = ReviewRating::all();
    //     dd($reviews);
    //     // return view('pages.homeInfoBuku', compact('review'));
    // }
