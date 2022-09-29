<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BestSellerController extends Controller
{
    public function index()
    {
        return view('pages.bestSeller');
    }
}
