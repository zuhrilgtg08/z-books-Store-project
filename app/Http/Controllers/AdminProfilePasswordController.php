<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class AdminProfilePasswordController extends Controller
{
    public function index($id)
    {
        $admin = User::findOrFail($id);
        return view('pages.admin.adminProfile.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $admin = User::findOrFail($id);
        $validateData = $request->validate([
            'name' => 'max:150',
            'email' => 'email:dns',
            'image' => 'image|file|max:1024',
            'alamat' => 'max:150',
            'number_phone' => 'numeric|min:10|integer',
        ]);

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validateData['image'] = $request->file('image')->store('uploaded-adminProfile');
        }

        $phone = $request->number_phone;
        if ($phone) {
            $result = sprintf("%s-%s-%s", substr($phone, 0, 4), substr($phone, 4, 4), substr($phone, 8));
            $validateData['number_phone'] = $result;
        }

        $admin->update($validateData);

        if ($admin) {
            return back()->with('success', 'Profile berhasil di ubah');
        } else {
            return back()->with('errors', 'Profile gagal di ubah');
        }
    }

    public function password($id)
    {
        $admin_pass = User::findOrFail($id);
        return view('pages.admin.adminProfile.changePassword', compact('admin_pass'));
    }

    public function changePassword(Request $request, $id)
    {
        $admin_pass = User::findOrFail($id);

        $request->validate([
            'old_pass' => 'required|string|min:8',
            'new_pass' => 'required|string|min:8',
            'confirm_pass' => 'required|string|min:8'
        ]);

        if ($admin_pass) {
            if (Hash::check($request->old_pass, $admin_pass->password)) {
                if ($request->new_pass == $request->confirm_pass) {
                    User::find($id)->update([
                        'password' => Hash::make($request->new_pass)
                    ]);

                    return back()->with('success', 'Password berhasil di ubah');
                } else {
                    return back()->with('erros', 'Password gagal diubah');
                }
            }
        }
    }
}