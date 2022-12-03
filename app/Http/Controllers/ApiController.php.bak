<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function paymentHandler(Request $request)
    {
        $response = json_decode($request->getContent());
        $signature_key = hash('sha512', $response->order_id . $response->status_code . $response->gross_amount . env('MIDTRANS_SERVER_KEY'));

        if ($signature_key != $response->signature_key) {
            return abort(400);
        }

        //status berhasil
        $order = Order::where('uuid', $response->order_id)->first();
        $order->update(['status' => $response->transaction_status]);

        dd($order);
    }
}
