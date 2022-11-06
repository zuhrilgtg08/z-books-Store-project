<?php

namespace App\Http\Controllers;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\User;
use App\Models\Province;
use App\Models\Cities;
use App\Models\Order;
use App\Models\Buku;
use Illuminate\Http\Request;
use App\Services\Midtrans\CreateSnapTokenService;

class CheckoutController extends Controller
{
    public function getCity($id)
    {
        $cities = Cities::where('province_id', '=', $id)->select(['id', 'nama_kab_kota'])->get();
        // $dataCity = json_encode($cities);
        return response()->json($cities);
    }

    public function getOngkir($origin, $destination, $weight, $courier)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=$origin&destination=$destination&weight=$weight&courier=$courier",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: 91dd56b26cc7b9a58d9c1112b28d9244"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = json_decode($response, true);
            $data_ongkir = $response['rajaongkir']['results'];
            return json_encode($data_ongkir);
        }
    }

    public function storeOrder(Request $request, Order $order) 
    {
        // $this->validate($request, [
        //     'user_id' => 'required|max:100',
        //     'province_id' => 'required|max:100',
        //     'city_id' => 'required|max:100',
        //     'destination_id' => 'required|max:100',
        //     'courier' => 'required|max:100',
        //     'quantity' => 'required|numeric',
            // 'total_belanja' => 'required|numeric',
        //     'weight' => 'required|numeric',
        //     'cost_services' => 'required|numeric',
        // ]);

        $paymentStatus = 1;
        $hargaTotal = ($request->cost_services + $request->total_belanja) + 2000;
        $snapToken = $order->snap_token;
        if (empty($snapToken)) {
            // Jika snap token masih NULL, buat token snap dan simpan ke database
            $midtrans = new CreateSnapTokenService($order);
            $snapToken = $midtrans->getSnapToken();
            $order->snap_token = $snapToken;
        }

        $validateData = [
            // 'user_id' => $request->user_id,
            // 'province_id' => $request->province_id,
            // 'city_id' => $request->city_id,
            // 'destination_id' => $request->destination_id,
            // 'courier' => $request->courier,
            // 'quantity' => $request->quantity,
            // 'weight' => $request->weight,
            // 'cost_services' => $request->cost_services,
            // 'total_belanja' => $request->total_belanja,
            'total_price' => $hargaTotal,
            'payment_status' => $paymentStatus,
            'snap_token' => $snapToken
        ];

        // dd($validateData);
        $order->create($validateData);

        if ($order) {
            return redirect()->route('tes')->with('success', 'Order berhasil di tambahkan');
        } else {
            return redirect()->route('tes')->with('errors', 'Order gagal di tambahkan');
        }
    }

    public function index(Order $order)
    {
        // $weightBuku = Buku::select('weight')->first();
        $midtrans = new CreateSnapTokenService($order);
        $snapToken = $midtrans->getSnapToken();
        $order->snap_token = $snapToken;
        
        // dd($token_snap);
        $cart = Cart::Content();
        $total_berat = 0;
        $qty_Total = 0;
        foreach ($cart as $item) {
            $total_berat += $item->weight * $item->qty;
            $qty_Total += $item->qty;
        }

        $allProvince = Province::all();
        return view('pages.checkout.index', [
            'provinces' => $allProvince,
            'totalBerat' => $total_berat,
            'qty_Total' => $qty_Total,
            'snapToken' => $snapToken
        ]);
    }

    // public function show(Order $order)
    // {
    //     // $hargaTotal = ($request->services + $request->total_belanja) + 2000;
    //     $snapToken = $order->snap_token;
    //     dd($snapToken);
    //     // dd($request->all(), $hargaTotal);
    //     return view('pages.checkout.index', compact('snapToken'));
    // }


    // public function tes(Request $request)
    // {
    //     // $buku = Buku::select('stok')->get();
    //     // $data = 
    //     $hargaTotal = ($request->services + $request->total_belanja) + 2000;
    //     dd($request->all(), $hargaTotal);
    //     // $totalHarga = 0;
    //     // foreach($hargaTotal as $data) {
    //     //     $totalHarga += $data;
    //     // }
    //     // dd($request->weight);
    //     // dd($hargaTotal);

    //     // $snapToken = $order->snap_token;
    //     // if (empty($snapToken)) {
    //     //     // Jika snap token masih NULL, buat token snap dan simpan ke database

    //     //     $midtrans = new CreateSnapTokenService($order);
    //     //     $snapToken = $midtrans->getSnapToken();

    //     //     $order->snap_token = $snapToken;
    //     //     $order->save();
    //     //     dd($snapToken);

    //     //     return view('pages.checkout.index',[
    //     //         'snapToken' => $snapToken
    //     //     ]);
    //     // }
    //     // return 'halo';
    // }
}

    
    
