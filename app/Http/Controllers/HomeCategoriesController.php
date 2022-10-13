<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HomeCategoriesController extends Controller
{
    public function index()
    {
        // $tag = '';
        // if (request('category')) {
        //     $category = Category::firstWhere('slug', request('category'));
        //     $tag = ' category: ' . $category->name;
        // }

        $dataCategories = Category::all();
        // dd($tag);
        return view('pages.categories',[
            // "tag" => $tag,
            "categories" => $dataCategories
        ]);
    }
}
