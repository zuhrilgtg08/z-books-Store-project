<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use Illuminate\Support\Facades\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (auth()->user()) {
                $keranjang = Keranjang::where('user_id', auth()->user()->id)
                                        ->where('status', '=', 'pending')->get();
                View::share('keranjang', $keranjang);
                
                $orders = Keranjang::with('order', 'buku')->where('user_id', '<>', 1)->where('status', 'pending')->get();
                View::share('orders', $orders);
            }

            return $next($request);
        });
    }
}
