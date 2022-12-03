<?php


namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\Midtrans\CallbackService;

class PaymentCallbackController extends Controller
{
    public function receive(Request $request)
    {
        return dd($request->getContent());
        // $callback = new CallbackService;

        // if ($callback->isSignatureKeyVerified()) {
        //     $notification = $callback->getNotification();
        //     $order = $callback->getOrder();

        //     if ($callback->isSuccess()) {
        //         Order::where('uuid', '=', $order->id)->update([
        //             'status' => "settlement",
        //         ]);
        //     }

        //     if ($callback->isExpire()) {
        //         Order::where('uuid', '=', $order->id)->update([
        //             'status' => "expired",
        //         ]);
        //     }

        //     if ($callback->isCancelled()) {
        //         Order::where('uuid', '=', $order->id)->update([
        //             'status' => "cancel",
        //         ]);
        //     }
            
        //     return dd(response()->json($request->getContent()));
        //     // return response()
        //     //     ->json([
        //     //         'success' => true,
        //     //         'message' => 'Notifikasi berhasil diproses',
        //     //     ]);
        // } else {
        //     // return response()
        //     //     ->json([
        //     //         'error' => true,
        //     //         'message' => 'Signature key tidak terverifikasi',
        //     //     ], 400);
        // }
        // $response = Http::post('https://5720-120-188-72-72.ap.ngrok.io/payments/midtrans-notifications');
    }

    public function tes()
    {
        return "halo paymentController";
    }
}

// // require_once(dirname(__FILE__) . '/Midtrans.php');
// \Midtrans\Config::$isProduction = false;
// \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
// $notif = new \Midtrans\Notification();

// $transaction = $notif->transaction_status;
// $type = $notif->payment_type;
// $order_id = $notif->order_id;
// $fraud = $notif->fraud_status;

// if ($transaction == 'capture') {
//     // For credit card transaction, we need to check whether transaction is challenge by FDS or not
//     if ($type == 'credit_card') {
//         if ($fraud == 'challenge') {
//             // TODO set payment status in merchant's database to 'Challenge by FDS'
//             // TODO merchant should decide whether this transaction is authorized or not in MAP
//             echo "Transaction order_id: " . $order_id . " is challenged by FDS";
//         } else {
//             // TODO set payment status in merchant's database to 'Success'
//             echo "Transaction order_id: " . $order_id . " successfully captured using " . $type;
//         }
//     }
// } else if ($transaction == 'settlement') {
//     // TODO set payment status in merchant's database to 'Settlement'
//     echo "Transaction order_id: " . $order_id . " successfully transfered using " . $type;
// } else if ($transaction == 'pending') {
//     // TODO set payment status in merchant's database to 'Pending'
//     echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
// } else if ($transaction == 'deny') {
//     // TODO set payment status in merchant's database to 'Denied'
//     echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
// } else if ($transaction == 'expire') {
//     // TODO set payment status in merchant's database to 'expire'
//     echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is expired.";
// } else if ($transaction == 'cancel') {
//     // TODO set payment status in merchant's database to 'Denied'
//     echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is canceled.";
// }