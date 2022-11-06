<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\ReviewRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BestSellerController extends Controller
{
    public function bestSellerBooks(Request $request)
    {
        #get nilai harga minus & harga max dari table harga
        $harga_min = Buku::min('harga');
        $harga_max = Buku::max('harga');

        #Get filter request parameters & set value
        $filter_harga_min = $request->harga_min;
        $filter_harga_max = $request->harga_max;

        #data buku ketika di filter
        if ($filter_harga_min && $filter_harga_max) {
            if ($filter_harga_min > 0 && $filter_harga_max > 0) {
                $bukus = Buku::select('judul_buku', 'harga','image', 'id')
                                ->whereBetween('harga', [$filter_harga_min, $filter_harga_max])
                                    ->orderBy('id', 'Desc')->get();
    
                $bukus = $bukus->map(function($buku) {
                    $bukuRatings = ReviewRating::where('id_buku', '=', $buku->id)->get();
                    if($bukuRatings->count() == 0) {
                        $buku->star_rating = 0;
                    } else {
                        $rating = $bukuRatings->sum('star_rating') / $bukuRatings->count();
                        $buku->star_rating = $rating;
                    }
                    return $buku;
                });

                $bestBukus = $bukus->filter(function($buku) {
                    return $buku->star_rating >= 4;
                });
            }
            #tampilkan semuanya jika user tidak filter
        } else {
            $bukus = Buku::with('user')->latest()->get();

            $bukus = $bukus->map(function ($buku) {
                $bukuRatings = ReviewRating::where('id_buku', '=', $buku->id)->get();
                if ($bukuRatings->count() == 0) {
                    $buku->star_rating = 0;
                } else {
                    $rating = $bukuRatings->sum('star_rating') / $bukuRatings->count();
                    $buku->star_rating = $rating;
                }
                return $buku;
            });

            $bestBukus = $bukus->filter(function ($buku) {
                return $buku->star_rating >= 4;
            });
        }
        
        return view('pages.bestSeller', [
            'bukus' => $bestBukus,
            'harga_min' => $harga_min,
            'harga_max' => $harga_max,
            'filter_harga_min' => $filter_harga_min,
            'filter_harga_max' => $filter_harga_max,
        ]);
    }
}