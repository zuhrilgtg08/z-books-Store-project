<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Author;
use App\Models\Category;
use App\Models\Penerbit;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = Buku::join('authors', 'authors.id', '=', 'bukus.author_id')
                        ->join('penerbits', 'penerbits.id', '=', 'bukus.penerbit_id')
                        ->join('categories', 'categories.id', '=', 'bukus.category_id')
                        ->orderBy('kode_buku', 'ASC')
                        ->get([
                                'bukus.id',
                                'bukus.kode_buku',
                                'bukus.judul_buku',
                                'bukus.harga',
                                'bukus.stok',
                                'bukus.image',
                                'authors.nama_author',
                                'penerbits.nama_penerbit',
                                'categories.name'
                            ]);

        return view('pages.admin.adminBuku.index', compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $results = [
            'authors' => Author::select('id', 'nama_author')->get(),
            'categories' => Category::select('id', 'name')->get(),
            'penerbits' => Penerbit::select('id', 'nama_penerbit')->get()
        ];

        return view('pages.admin.adminBuku.create', $results);
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
            'judul_buku' => 'required|max:255|unique:bukus',
            'harga' => 'required|numeric|integer|min:1',
            'stok' => 'required|numeric|integer|min:1',
            'category_id' => 'required|max:150',
            'author_id' => 'required|max:150',
            'penerbit_id' => 'required|max:150',
            'image' => 'required|image|file|max:1024',
            'sinopsis' => 'required|string',
            'weight' => 'required|numeric|integer|min:1'
        ]);

        $kodeDepan = strtoupper(substr($request->judul_buku, 0, 1));
        $data = Buku::where('judul_buku', 'like', $kodeDepan . '%')->orderBy('id', 'DESC')->first();

        if ($data) {
            $old = ltrim($data->kode_buku, $kodeDepan);
            $number = $old + 1;
            if ($number < 10) {
                $nol = '000';
            } elseif ($number < 1000) {
                $nol = '00';
            } elseif ($number < 100) {
                $nol = '0';
            } else {
                $nol = '';
            }
            $fixKode = $kodeDepan . $nol . $number;
        } else {
            $fixKode = $kodeDepan . '0001';
        }

        $validateData = [
            'kode_buku' => $fixKode,
            'judul_buku' => $request->judul_buku,
            'harga' => $request->input('harga'),
            'stok' => $request->input('stok'),
            'category_id' => $request->category_id,
            'author_id' => $request->author_id,
            'penerbit_id' => $request->penerbit_id,
            'sinopsis' => $request->sinopsis,
            'weight' => $request->weight
        ];

        if ($request->file('image')) {
            $validateData['image'] = $request->file('image')->store('uploaded-buku');
        }

        $validateData['excerpt'] = Str::limit(strip_tags($request->sinopsis), 50);
        
        if(!$validateData['harga'] == 0) {
            $validateData['harga'] = $request->harga;
        } else {
            $validateData['harga'] = 50000;
        }

        $buku = Buku::create($validateData);

        if ($buku) {
            return redirect()->route('buku.index')->with('success', 'Buku berhasil di tambahkan');
        } else {
            return redirect()->route('buku.index')->with('errors', 'Buku gagal di tambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $datas = [
            'buku' => Buku::findOrFail($id),
            'authors' => Author::select('id', 'nama_author')->get(),
            'categories' => Category::select('id', 'name')->get(),
            'penerbits' => Penerbit::select('id', 'nama_penerbit')->get()
        ];

        return view('pages.admin.adminBuku.show', compact('datas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $results = [
            'buku' => Buku::findOrFail($id),
            'authors' => Author::select('id', 'nama_author')->get(),
            'categories' => Category::select('id', 'name')->get(),
            'penerbits' => Penerbit::select('id', 'nama_penerbit')->get()
        ];

        return view('pages.admin.adminBuku.edit', $results);
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
        $data = [
            'judul_buku' => 'required|max:255',
            'harga' => 'required|numeric|integer|min:1',
            'stok' => 'required|numeric|integer|min:1',
            'category_id' => 'required|max:150',
            'author_id' => 'required|max:150',
            'penerbit_id' => 'required|max:150',
            'image' => 'image|file|max:1024',
            'sinopsis' => 'required|string',
            'weight' => 'required|numeric|integer|min:1'
        ];

        $validateData = $request->validate($data);

        if ($request->file('image')) {
            if ($request->oldCover) {
                Storage::delete($request->oldCover);
            }
            $validateData['image'] = $request->file('image')->store('uploaded-buku');
        }

        $validateData['excerpt'] = Str::limit(strip_tags($request->sinopsis), 50);

        $buku = Buku::find($id)->update($validateData);

        if ($buku) {
            return redirect()->route('buku.index')->with('success', 'Buku berhasil di ubah');
        } else {
            return redirect()->route('buku.index')->with('errors', 'Buku gagal di ubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Buku $buku)
    {
        if ($buku->image) {
            Storage::delete($buku->image);
        }

        Buku::destroy($buku->id);
        return redirect()->route('buku.index')->with('errors', 'Buku berhasil di hapus');
    }
}
