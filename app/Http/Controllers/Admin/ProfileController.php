<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile');
    }

    public function changeProfilePhoto(Request $request, $id)
    {
        $validated = $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // Upload gambar
        $imageName = time().'.'.$request->gambar->extension();
        $request->gambar->move(public_path('uploads/profile'), $imageName);
        $user = User::find($id);
        $user->gambar = $imageName;
        $user->update();
        return redirect()->back()->with('success', 'Profile berhasil diubah');
    }

    public function updateProfile(Request $request,$id)
    {
        $validated = $request->validate([
            'name'          => 'required',
            'email'         => 'required|email|unique:users,email,'.$id,
        ]);

        if($validated){
            $user = User::find($id);
            $user->name     = $request->name;
            $user->email    = $request->email;
            $user->update();
            return redirect()->back()->with('success', 'Profile berhasil diubah');
        }else{
            return redirect()->back()->with('error', 'Profile gagal diubah');
        }
    }

    public function updatePass(Request $request, $id)
    {
        $user       = User::find($id);
        $getOldPass = $user->password;

        if(password_verify($request->oldPass, $getOldPass)){
            $validated = $request->validate([
                'newPass'       => 'required|min:3',
                'passConf'      => 'required|same:newPass',
            ]);
            if($validated){
                $user->password = Hash::make($request->newPass);
                $user->update();
                return redirect()->back()->with('success', 'Password berhasil diubah');
            }else{
                return redirect()->back()->with('error', 'Password gagal diubah');
            }
        }else{
            return redirect()->back()->with('error', 'Password gagal diubah');
        }

    }
}
