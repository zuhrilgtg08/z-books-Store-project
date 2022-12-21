<?php

namespace App\Http\Controllers;
use App\Models\Buku;
use App\Models\User;
use App\Models\Order;
use App\Models\Cities;
use App\Models\Province;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Services\Midtrans\CreateSnapTokenService;

class CheckoutController extends Controller
{
    private $province;
    private $cities;
    private $keranjang;
    private $order;

    public function __construct()
    {
        $this->province = new Province();
        $this->cities = new Cities();
        $this->keranjang = new Keranjang();
        $this->order = new Order();
    }

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
        $order = Order::all();
        $provinces = Province::all();
        $itemData = Keranjang::with('buku')->where('user_id', Auth::user()->id)
                                ->where('status', '<>', 'complete')->get();
        $totalBelanja = 0;
        $totalBerat = 0;
        $snapToken = null;
        foreach ($order as $data) {
            $snapToken = $data->snap_token;
        }
        foreach($itemData as $item) {
            $totalBerat += $item->buku->weight * $item->quantity;
            $totalBelanja += $item->buku->harga * $item->quantity;
        }
    
        return view('pages.checkout.create', 
            compact('provinces', 'totalBerat', 'totalBelanja', 'itemData', 'snapToken'));
    }
    
    public function store(Request $request) 
    {
        $validateData = $request->validate([
            'keranjang_id' => 'required|max:150',
            'province_id' => 'required|max:150',
            'destination_id' => 'required|max:150',
            'courier' => 'required|max:150',
            'weight' => 'required|numeric',
            'alamat' => 'required|max:150',
            'harga_ongkir' => 'required|numeric',
            'layanan_ongkir' => 'required|string',
            'total_belanja' => 'required|numeric',
        ]);

        $order = Order::create($validateData);

        $dataKeranjang = Keranjang::with('order')->where('user_id', Auth::user()->id)
                                    ->where('status', '<>', 'complete')
                                    ->get();

        foreach ($dataKeranjang as $data) {
            $data->buku->update([
                'stok' => $data->buku->stok - $data->quantity
            ]);

            $data->update([
                'order_id' => $order->id
            ]);

            if(!empty($data->order_id)) {
                $midtrans = new CreateSnapTokenService($order);
                $snapToken = $midtrans->getSnapToken();
                $order->update(['snap_token' => $snapToken]);
            }
        }

        if ($order) {
            return redirect()->route('checkout.pembayaran')->with('success', 'Pesanan berhasil di tambahkan');
        } else {
            return redirect()->route('checkout.pembayaran')->with('errors', 'Pesanan gagal di tambahkan');
        }
    }

    public function pembayaran()
    {
        $dataPesanan = Order::with('cities', 'province')->where('transaction_status', null)->get();
        $dataKeranjang = Keranjang::with('buku')->where('user_id', Auth::user()->id)->where('status', '<>', 'complete')->get();

        foreach ($dataPesanan as $item) {
            $snapToken = $item->snap_token;
        }

        return view('pages.checkout.pembayaran', compact('snapToken', 'dataPesanan', 'dataKeranjang'));
    }

    public function konfirmasiPembayaran(Request $request)
    {
        $keranjang = Keranjang::where('user_id', Auth::user()->id)
                                ->where('payments', null)->get();
                                
        $jsonOrder = json_decode($request->json);
        $dataOrder = [
            'transaction_id' => $jsonOrder->transaction_id,
            'transaction_status' => $jsonOrder->transaction_status,
            'transaction_time' => $jsonOrder->transaction_time,
            'payment_type' => $jsonOrder->payment_type,
            'payment_code' => isset($jsonOrder->payment_code) ? $jsonOrder->payment_code : null,
        ];

        foreach($keranjang as $data ) {
            $data->update([
                'status' => 'complete',
                'payments' => 'lunas'
            ]);
        }

        $order = Order::where('uuid', '=', $jsonOrder->order_id);
        if ($order) {
            $order->update($dataOrder);
        }

        if ($order) {
            return redirect()->route('customer_order_history.index')->with('success', 'Pesanan berhasil di bayar');
        } else {
            return redirect()->route('customer_order_history.index')->with('errors', 'Pesanan gagal di bayar');
        }
    }
}
