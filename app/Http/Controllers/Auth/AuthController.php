<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function doLogin(Request $request)
    {
        $request->validate([
            'email'         => 'required|email',
            'password'      => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            if (auth()->user()->role == 'admin') 
            {
                return redirect()->route('admin.index');
            } elseif (auth()->user()->role == 'client') 
            {
                return redirect()->route('client.index');
            }elseif (auth()->user()->role == 'guest') 
            {
                return redirect()->route('guest.index');
            }
        }
        return redirect()->back()->with('error', 'Oppss! Email atau Password salah.');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function doRegister(Request $request)
    {
        $validatedData = $request->validate([
            'firstname'             => 'required',
            'lastname'              => 'required',
            'email'                 => 'required|email|unique:users',
            'pass'                  => 'required|min:3',
            'passConf'              => 'required|same:pass',
        ]);
        User::create([
            'name'      => $request->firstname . ' ' . $request->lastname,
            'email'     => $request->email,
            'password'  => Hash::make($request->pass),
            'role'      => 'guest',
        ]);
        return redirect()->route('auth.login')->with('pesan', 'Berhasil mendaftar, silahkan login.');
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('welcome');
    }

}
