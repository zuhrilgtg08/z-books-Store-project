<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::Content();
        $total_berat = 0;
        foreach ($cart as $item) {
            $total_berat += $item->weight * $item->qty;
        }
        // dd($cart);
        // dd($total_berat);
        return view('pages.homeCart.index', compact('cart', 'total_berat'));
    }

    public function store(Request $request)
    {
        $product_buku = Buku::findOrfail($request->input('buku_product_id'));
        Cart::add(
            [
                'id' => $product_buku->id,
                'name' => $product_buku->judul_buku,
                'qty' => $request->input('quantity'),
                'price' => $product_buku->harga,
                'weight' => $product_buku->weight,
                'options' => [
                    'kode_buku' => $product_buku->kode_buku, 
                    'image' => $request->input('image'),
                    'stok' => $product_buku->stok
                ],
            ]
        );

        return redirect()->route('cart.index')->with('success', 'Buku berhasil ditambahkan ke Keranjang!');
    }

    public function update(Request $request)
    {
        $rowId = $request->rowId;
        // $buku = Buku::find($request->id);
        Cart::update($rowId, [
            // "price" => $buku->harga * $request->quantity,
            "qty" => $request->quantity,
        ]);

        return redirect()->route('cart.index')->with('success', 'Buku pesanan anda berhasil diupdate!');
    }

    public function remove(Request $request)
    {
        $rowId = $request->rowId;
        Cart::remove($rowId);

        return redirect()->route('cart.index')->with('delete', 'Buku pesanan anda dihapus dari Keranjang!');
    }

    public function sumWeight(Request $request) {
        $berat_buku = Buku::findOrfail($request->input('buku_product_id'));
        dd($berat_buku);
    }
}
