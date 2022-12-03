<?php

namespace App\Services\Midtrans;

use Midtrans\Snap;
use Illuminate\Support\Facades\Auth;
use App\Models\Keranjang;
use App\Models\Order;

class CreateSnapTokenService extends Midtrans
{
    protected $order;

    public function __construct($order)
    {
        parent::__construct();

        $this->order = $order;
    }

    public function getSnapToken()
    {
        $item_details = [];
        $dataCart = Keranjang::with('buku')->where('status', '=', 'settlement')->get();

        foreach($dataCart as $item) {
            $item_details[] = [
                'id' => $item->uuid,
                'price' => $item->buku->harga,
                'quantity' => $item->quantity,
                'name' => $item->buku->judul_buku
            ];
        }

        $item_details[] = [
            'id' => $this->order->id,
            'price' => $this->order->harga_ongkir,
            'name' => 'Ongkos Kirim',
            'quantity' => 1
        ];

        $params = [
            'transaction_details' => [
                'order_id' => $this->order->uuid,
                'gross_amount' => $this->order->total_harga_akhir,
            ],
            'item_details' => $item_details,
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'phone' => Auth::user()->number_phone,
            ]
        ];

        $snapToken = Snap::getSnapToken($params);

        return $snapToken;
    }
}
