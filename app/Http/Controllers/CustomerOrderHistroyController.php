<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;


class CustomerOrderHistroyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resultOrder = Keranjang::with(['buku'])->where('user_id', Auth::user()->id)
                                ->where('payments', 'lunas')->get();

        return view('pages.historyOrderCustomer.historyCustomer', compact('resultOrder'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detailOrder = Keranjang::where('order_id', $id)->get();
        $noInvoice = null;
        $province = null;
        $kota = null;
        $alamat = null;
        $kurir = null;
        $paket = null;
        $ongkir = 0;
        $beli = 0;
        $total = 0;

        $no_telp = sprintf("%s-%s-%s", substr(Auth::user()->number_phone, 0, 4), substr(Auth::user()->number_phone, 4, 4), substr(Auth::user()->number_phone, 8));

        foreach($detailOrder as $data) {
            $kurir = $data->order->courier;
            $paket = $data->order->layanan_ongkir;
            $ongkir = $data->order->harga_ongkir;
            $beli = $data->order->total_belanja;
            $total = $data->order->harga_ongkir + $data->order->total_belanja;
            $noInvoice = $data->order->uuid;
            $province = $data->order->province->name_province;
            $kota = $data->order->cities->nama_kab_kota;
            $alamat = $data->order->alamat;
        }

        return view('pages.historyOrderCustomer.detailHistory', 
            compact(
                'detailOrder', 'kurir', 'paket', 'ongkir', 'beli',
                'noInvoice', 'total', 
                'province', 
                'kota', 
                'alamat', 
                'no_telp'
            ));
    }

    public function detailExport($id)
    {
        $dataOrder = Keranjang::with('buku', 'order')->where('user_id', Auth::user()->id)
                            ->where('order_id', $id)->get();

        $noInvoice = null;
        $province = null;
        $kota = null;
        $alamat = null;
        $kurir = null;
        $paket = null;
        $ongkir = 0;
        $beli = 0;
        $total = 0;
        $no_telp = sprintf("%s-%s-%s", substr(Auth::user()->number_phone, 0, 4), substr(Auth::user()->number_phone, 4, 4), substr(Auth::user()->number_phone, 8));

        foreach ($dataOrder as $data) {
            $kurir = $data->order->courier;
            $paket = $data->order->layanan_ongkir;
            $ongkir = $data->order->harga_ongkir;
            $beli = $data->order->total_belanja;
            $total = $data->order->harga_ongkir + $data->order->total_belanja;
            $noInvoice = $data->order->uuid;
            $province = $data->order->province->name_province;
            $kota = $data->order->cities->nama_kab_kota;
            $alamat = $data->order->alamat;
        }

        $pdf = PDF::loadView('Lpdf.historyCustomer',
            compact(
                'dataOrder', 'kurir', 'paket',
                'ongkir', 'beli', 'noInvoice', 'total',
                'province', 'kota', 'alamat', 'no_telp'
            )
        );
        return $pdf->download("detail_order " . date('d-m-Y') . '.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Keranjang::findOrFail($id);
        $order->delete();
        return redirect()->route('customer_order_history.index')->with('errors', 'Data pesanan berhasil dihapus');
    }
}
