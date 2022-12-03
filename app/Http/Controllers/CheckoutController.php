<?php

namespace App\Http\Controllers;
use App\Models\Buku;
use App\Models\User;
use App\Models\Order;
use App\Models\Cities;
use App\Models\Province;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\Midtrans\CreateSnapTokenService;

class CheckoutController extends Controller
{
    public function getCity($id)
    {
        $cities = Cities::where('province_id', '=', $id)->select(['id', 'nama_kab_kota'])->get();
        return response()->json($cities);
    }

    public function getOngkir($destination, $weight, $courier)
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
            CURLOPT_POSTFIELDS => "origin=444&destination=$destination&weight=$weight&courier=$courier",
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

    public function create()
    {
        $totalBelanja = 0;
        $totalBerat = 0;
        $provinces = Province::all();
        $itemData = Keranjang::with('buku')->where('user_id', Auth::user()->id)->get();
        foreach($itemData as $item) {
            $totalBerat += $item->buku->weight * $item->quantity;
            $totalBelanja += $item->buku->harga * $item->quantity;
        }

        return view('pages.checkout.create', 
            compact('provinces', 'totalBerat', 'totalBelanja', 'itemData'));
    }
    
    public function store(Request $request) 
    {
        // dd($request->all());
        $validateData = $request->validate([
            'keranjang_id' => 'required|max:150',
            'province_id' => 'required|max:150',
            'destination_id' => 'required|max:150',
            'courier' => 'required|max:150',
            'weight' => 'required|numeric',
            'alamat' => 'required|max:150',
            'harga_ongkir' => 'required|numeric',
            'total_belanja' => 'required|numeric',
        ]);

        $dataKeranjang = Keranjang::where('user_id', Auth::user()->id)->get();
        foreach($dataKeranjang as $data) {
            $data['status'] = 'settlement';
            $data->update();
        }
        
        $order = Order::create($validateData);

        if ($order) {
            if (empty($validateData['snap_token'])) {
                $midtrans = new CreateSnapTokenService($order);
                $snapToken = $midtrans->getSnapToken();
                $order->update(['snap_token' => $snapToken]);
            }
            return redirect()->route('checkout.valid')->with('success', 'Pesanan berhasil di tambahkan');
        } else {
            return redirect()->route('checkout.valid')->with('errors', 'Pesanan gagal di tambahkan');
        }
        // dd($order);
    }

    public function valid()
    {
        // $dataValid = Order::where('user_id', '=', Auth::user()->id)->get();
        $dataValid = Order::all();
        $provinsi = 0;
        $snapToken = null;
        foreach ($dataValid as $item) {
            $snapToken = $item->snap_token;
            $provinsi = $item->province_id;
        }

        return view('pages.checkout.valid', compact('snapToken', 'provinsi'));
    }


    

    public function confirm(Request $request)
    {
        
    }

    // public function show(Order $order)
    // {
    //     $newSnapToken = null;
    //     foreach($order as $data) {
    //         $newSnapToken = $data->snap_token;
    //     }
        
    //     return view('pages.checkout.index',[
    //         'snapToken' => $newSnapToken
    //     ]);
    // }

    

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

    
    