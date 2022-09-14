<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::where('status_type', '<>', 1)
                        ->orderBy('id', 'ASC')
                        ->get();
        return view('pages.admin.adminCustomers.index', compact('customers'));
    }

    public function show($id)
    {
        $detail = User::findOrFail($id);
        return view('pages.admin.adminCustomers.show', compact('detail'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('customer.index')->with('errors', 'Customer berhasil di delete');
    }
}
