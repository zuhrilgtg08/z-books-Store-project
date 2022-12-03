<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeCategoriesController extends Controller
{
    public function index()
    { 
        $dataCategories = Category::all();
        return view('pages.categories',[
            "categories" => $dataCategories
        ]);
    }
}
