<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Order;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $resultOrder = Keranjang::with('order', 'buku')->where('user_id', '<>', 1)->withTrashed()->get();
        $code = null;
        foreach($resultOrder as $data) {
            $code = $data->order->uuid;
        }

        if (strlen($code)) {
            $newCode = substr($code, 0, -28);
        } else {
            $code;
        }

        return view('pages.admin.adminOrders.index', compact('resultOrder', 'newCode'));
    }

    public function createPdf()
    {
        $data = Keranjang::with('order', 'buku')->withTrashed()->get();
        $pdf = PDF::loadView('Lpdf.orderAdmin', compact('data'));
        $pdf->setPaper('legal', 'landscape');
        return $pdf->download("data_riwayat_customer " . date('d-m-Y') . '.pdf');
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
        $dataOrder = Keranjang::with('order', 'buku')->where('order_id', $id)
                                ->where('user_id', '!=', 1)->withTrashed()->get();
        $noInvoice = null;
        $province = null;
        $kota = null;
        $alamat = null;
        $kurir = null;
        $paket = null;
        $ongkir = 0;
        $beli = 0;
        $total = 0;

        foreach ($dataOrder as $data) {
            $nama = $data->user->name;
            $no_telp = $data->user->number_phone;
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

        return view('pages.admin.adminOrders.show', 
                compact(
                'dataOrder', 'kurir', 'paket', 'ongkir', 'beli',
                'noInvoice', 'total', 'nama',
                'province', 
                'kota', 
                'alamat', 
                'no_telp'
            ));
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
        //
    }
}
