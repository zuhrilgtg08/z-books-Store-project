<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserProfilePasswordController extends Controller
{
    public function index($id)
    {
        $customer = User::findOrFail($id);
        return view('pages.customer.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = User::findOrFail($id);
        $validateData = $request->validate([
            'name' => 'max:150',
            'email' => 'email:dns',
            'image' => 'image|file|max:1024',
            'alamat' => 'max:150',
            'number_phone' => 'numeric|min:10',
        ]);

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validateData['image'] = $request->file('image')->store('uploaded-userProfile');
        }

        $phone = $request->number_phone;
        if ($phone) {
            $result = sprintf("%s-%s-%s", substr($phone, 0, 4), substr($phone, 4, 4), substr($phone, 8));
            $validateData['number_phone'] = $result;
        }

        $customer->update($validateData);

        if ($customer) {
            return back()->with('success', 'Profile Anda berhasil di ubah');
        } else {
            return back()->with('errors', 'Profile Anda gagal di ubah');
        }
    }

    public function password($id)
    {
        $customer_pass = User::findOrFail($id);
        return view('pages.customer.changePassword', compact('customer_pass'));
    }

    public function changePassword(Request $request, $id)
    {
        $customer_pass = User::findOrFail($id);

        $request->validate([
            'old_pass' => 'required|string|min:8',
            'new_pass' => 'required|string|min:8',
            'confirm_pass' => 'required|string|min:8'
        ]);

        if ($customer_pass) {
            if (Hash::check($request->old_pass, $customer_pass->password)) {
                if ($request->new_pass == $request->confirm_pass) {
                    User::find($id)->update([
                        'password' => Hash::make($request->new_pass)
                    ]);
                    return back()->with('success', 'Password Anda berhasil di ubah');
                }
            }
            return back()->with('gagal', 'Password Anda gagal di ubah');
        }
    }
}
