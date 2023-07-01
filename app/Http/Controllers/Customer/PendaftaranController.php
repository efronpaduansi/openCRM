<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Prospek;
class PendaftaranController extends Controller
{
    public function index()
    {
        $produk = Produk::all();
        return view('guest.pilih_produk', compact('produk'));
    }

    public function list_produk()
    {
        $produks = Produk::all();
        return view('guest.list_produk', compact('produks'));
    }
    public function pendaftaran($id)
    {
        $produk = Produk::find($id);
        return view('guest.pendaftaran', compact('produk'));
    }

    public function store(Request $request)
    {
        // validasi data
        $validated = $request->validate([
            'fullname'      => 'required',
            'email'         => 'required|email|unique:prospeks',
            'phone'         => 'required',
            'address'       => 'required',
            'city'          => 'required',
            'province'      => 'required',
            'zip_code'      => 'required|numeric',
            'identity_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($validated)
        {
            // proses upload file
            $imageName = time().'.'.$request->identity_img->extension();  
            $request->identity_img->move(public_path('uploads/ktp'), $imageName);

            // proses simpan data
            $prospek                = new Prospek();
            $prospek->produk_id     = $request->produk_id;
            $prospek->user_id       = auth()->user()->id;
            $prospek->status_id     = 1;
            $prospek->fullname      = $request->fullname;
            $prospek->email         = $request->email;
            $prospek->phone         = $request->phone;
            $prospek->address       = $request->address;
            $prospek->city          = $request->city;
            $prospek->province      = $request->province;
            $prospek->zip_code      = $request->zip_code;
            $prospek->identity_img  = $imageName;
            $prospek->save();

            return redirect()->back()->with('success', 'Data anda berhasil terkirim');
        }
    }
}
