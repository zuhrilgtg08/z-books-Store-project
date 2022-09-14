<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.adminCategory.index', [
            'category' => Category::orderBy('name', 'ASC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.adminCategory.create');
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
            'name' => 'required|unique:categories',
            'slug' => 'required|unique:categories'
        ]);

        $categories = Category::create($validateData);

        if ($categories) {
            return redirect()->route('categories.index')->with('success', 'Category berhasil ditambahkan');
        } else {
            return redirect()->route('categories.index')->with('errors', 'Category gagal ditambahkan');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editCategory = Category::findOrFail($id);
        return view('pages.admin.adminCategory.edit', [
            'category' => $editCategory
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
        $validateData = $request->validate([
            'name' => 'required|unique:categories|max:255',
            'slug' => 'required|unique:categories'
        ]);

        $category = Category::findOrFail($id);
        $category->update($validateData);

        if ($category) {
            return redirect()->route('categories.index')->with('success', 'Category berhasil diubah');
        } else {
            return redirect()->route('categories.index')->with('errors', 'Category gagal diubah');
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
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index')->with('errors', 'Category berhasil dihapus');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Category::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
