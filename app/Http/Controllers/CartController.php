<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $result = Keranjang::where('user_id', Auth::user()->id)
                            ->where('status', '=', 'pending')->get();
        $total = 0;
        foreach ($result as $item) {
            if($item->quantity >= $item->buku->stok) {
                $total += $item->buku->stok * $item->buku->harga;
            } else {
                $total += $item->quantity * $item->buku->harga;
            }
        }

        return view('pages.homeCart.index', compact('result', 'total'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'buku_id' => 'required',
        ]);

        $allItem = Keranjang::with('buku')->where('buku_id', $request->buku_id)->get();
        foreach ($allItem as $data) {
            if($data->quantity >= $data->buku->stok) {
                $data['quantity'] = $data->quantity;
                return redirect()->route('cart.index')->with('delete', 'Ups, anda memesan melebihi stok yang tersedia');
            } else {
                $data->quantity;
            }
        }

        $item = Keranjang::where('buku_id', $request->buku_id)
                            ->where('user_id', auth()->user()->id)
                            ->where('status', '<>', 'settlement')->first();
        if ($item) {
            $item->update(['quantity' => $item->quantity + 1]);
            $validatedData['user_id'] = auth()->user()->id;
            $validatedData['status'] = 'pending';
        } else {
            $validatedData['user_id'] = auth()->user()->id;
            $validatedData['quantity'] = $request->quantity;
            $validatedData['status'] = 'pending';
            Keranjang::create($validatedData);
        }
        return redirect()->route('cart.index')->with('success', 'Buku berhasil ditambahkan ke Keranjang!');
    }

    public function update(Request $request, $id)
    {
        $datas = [
            'quantity' => $request->input('quantity'),
        ];

        Keranjang::findOrFail($id)->update($datas);

        return redirect()->route('cart.index')->with('success', 'Buku pesanan anda berhasil diupdate!');
    }

    public function remove($id)
    {
        Keranjang::destroy($id);
        return redirect()->route('cart.index')->with('delete', 'Buku pesanan anda dihapus dari Keranjang!');
    }
}
