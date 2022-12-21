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
        $dataOrder = Keranjang::with('buku', 'order')
                                ->where('payments', null)
                                ->where('status', 'pending')->get();
                            
        $item_details = [];

        foreach($dataOrder as $item) {
            $item_details[] = [
                'id' => $this->order->uuid,
                'price' => $item->buku->harga,
                'quantity' => $item->quantity,
                'name' => $item->buku->judul_buku
            ];
        }

        $item_details[] = [
            'id' => $this->order->uuid,
            'price' => $this->order->harga_ongkir,
            'name' => 'Ongkos Kirim',
            'quantity' => 1
        ];

        $params = [
            'transaction_details' => [
                'order_id' => $this->order->uuid,
                'gross_amount' => $this->order->total_belanja + $this->order->harga_ongkir,
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
