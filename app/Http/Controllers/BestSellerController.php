<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
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
                $buku = Buku::select('judul_buku', 'harga', 'stok', 'image')
                    ->whereBetween('harga', [$filter_harga_min, $filter_harga_max])
                    ->orderBy('id', 'Desc')->get();
            }
            #tampilkan semuanya jika user tidak filter
        } else {
            $buku = Buku::all();
        }

        return view(
            'pages.bestSeller',
            compact('buku', 'harga_min', 'harga_max', 'filter_harga_min', 'filter_harga_max')
        );
    }
}
