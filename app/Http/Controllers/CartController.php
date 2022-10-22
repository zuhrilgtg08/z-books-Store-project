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
        // dd($cart);
        return view('pages.homeCart.index', compact('cart'));
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
                'weight' => 0,
                'options' => [
                    'image' => $request->input('image'),
                    'stok' => $product_buku->stok
                ],
            ]
        );

        return redirect()->route('cart.index')->with('success', 'cart berhasil ditambahkan!');
    }

    public function update(Request $request)
    {
        $rowId = $request->rowId;
        // $buku = Buku::find($request->id);
        Cart::update($rowId, [
            // "price" => $buku->harga * $request->quantity,
            "qty" => $request->quantity,
        ]);

        return redirect()->route('cart.index')->with('success', 'cart berhasil diupdate!');
    }

    public function remove(Request $request)
    {
        $rowId = $request->rowId;
        Cart::remove($rowId);

        return redirect()->route('cart.index')->with('delete', 'cart item berhasil dihapus!');
    }
}
