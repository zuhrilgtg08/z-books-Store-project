<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penerbit;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class PenerbitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.adminPenerbit.index', [
            "penerbits" => Penerbit::orderBy('kode_terbit', 'ASC')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.adminPenerbit.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_penerbit' => 'required',
            'slug' => 'required|unique:penerbits',
            'tahun_terbit' => 'required|numeric|min:4'
        ]);

        $kodeDepan = strtoupper(substr($request->nama_penerbit, 0, 1));
        $data = Penerbit::where('nama_penerbit', 'like', $kodeDepan . '%')->orderBy('id', 'DESC')->first();

        if ($data) {
            $old = ltrim($data->kode_terbit, $kodeDepan);
            $number = $old + 1;
            if ($number < 10) {
                $nol = '00000';
            } elseif ($number < 100) {
                $nol = '0000';
            } elseif ($number < 100) {
                $nol = '000';
            } elseif ($number < 1000) {
                $nol = '00';
            } elseif ($number < 10000) {
                $nol = '0';
            } else {
                $nol = '';
            }
            $fixKode = $kodeDepan . $nol . $number;
        } else {
            $fixKode = $kodeDepan . '000001';
        }

        $result = [
            'kode_terbit' => $fixKode,
            'nama_penerbit' => $request->nama_penerbit,
            'slug' => $request->slug,
            'tahun_terbit' => $request->tahun_terbit
        ];

        $penerbit = Penerbit::create($result);

        if ($penerbit) {
            return redirect()->route('penerbit.index')->with('success', 'Penerbit berhasil di tambahkan');
        } else {
            return redirect()->route('penerbit.index')->with('errors', 'Penerbit gagal di tambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Penerbit $penerbit)
    {
        return view('pages.admin.adminPenerbit.show', [
            "penerbit" => $penerbit
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editPenerbit = Penerbit::findOrFail($id);
        return view('pages.admin.adminPenerbit.edit', [
            "penerbit" => $editPenerbit
        ]);
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
        $this->validate($request, [
            'nama_penerbit' => 'required',
            'slug' => 'required|unique:penerbits',
            'tahun_terbit' => 'required|numeric|min:4'
        ]);

        $result = [
            'nama_penerbit' => $request->nama_penerbit,
            'slug' => $request->slug,
            'tahun_terbit' => $request->tahun_terbit
        ];

        $penerbit = Penerbit::findOrFail($id);
        $penerbit->update($result);

        if ($penerbit) {
            return redirect()->route('penerbit.index')->with('success', 'Penerbit berhasil di update');
        } else {
            return redirect()->route('penerbit.index')->with('errors', 'Penerbit gagal di update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $penerbit = Penerbit::findOrFail($id);
        $penerbit->delete();
        return redirect()->route('penerbit.index')->with('errors', 'Penerbit berhasil di delete');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Penerbit::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}