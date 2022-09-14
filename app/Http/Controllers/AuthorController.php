<?php

namespace App\Http\Controllers;

use App\Models\Author;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.adminAuthor.index', [
            "author" => Author::orderBy('nama_author', 'ASC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.adminAuthor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama_author' => 'required|max:255',
            'slug' => 'required|unique:authors',
            'image' => 'required|file|max:1024',
            'biografi_author' => 'required'
        ]);

        if ($request->file('image')) {
            $validateData['image'] = $request->file('image')->store('uploaded-author');
        }

        $validateData['excerpt'] = Str::limit(strip_tags($request->biografi_author), 50);

        $author = Author::create($validateData);

        if ($author) {
            return redirect()->route('author.index')->with('success', 'Author berhasil di tambahkan');
        } else {
            return redirect()->route('author.index')->with('errors', 'Author gagal di tambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        return view('pages.admin.adminAuthor.show', [
            'author' => $author
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
        $editAuthor = Author::findOrFail($id);
        return view('pages.admin.adminAuthor.edit', [
            'author' => $editAuthor
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
        $datas = [
            'nama_author' => 'required|max:255',
            'slug' => 'required|unique:authors',
            'image' => 'image|file|max:1024',
            'biografi_author' => 'required'
        ];

        $validateData = $request->validate($datas);

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validateData['image'] = $request->file('image')->store('uploaded-author');
        }

        $validateData['excerpt'] = Str::limit(strip_tags($request->biografi_author), 50);

        $author = Author::findOrFail($id);
        $author->update($validateData);

        if ($author) {
            return redirect()->route('author.index')->with('success', 'Author berhasil di update');
        } else {
            return redirect()->route('author.index')->with('errors', 'Author gagal di update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        if ($author->image) {
            Storage::delete($author->image);
        }

        Author::destroy($author->id);
        return redirect()->route('author.index')->with('errors', 'Author berhasil di delete');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Author::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
