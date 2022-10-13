<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class PesanController extends Controller
{
    public function cartIndex($id, Request $request)
    {
        $cartBuku = Buku::select(
                            'id', 
                            'judul_buku', 
                            'image',
                            'stok',
                            'harga',
                            'excerpt')->where('id', '=', $id)->get();

        // dd($cartBuku);
        // $validateData = $request->validate([
        //     'jumlah' => "required|numeric|max:$request->stok"
        // ]);

        
        return view('pages.homeCart.index', ['cartBuku' => $cartBuku]);
    }

    public function cartOrder()
    {
        return view('pages.homeCart.cart');
    }
}
