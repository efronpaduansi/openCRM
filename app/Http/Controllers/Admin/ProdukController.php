<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Client;
use App\Models\Notification;
use App\Models\Prospek;
class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::all();
        return view('admin.produk', compact('produk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk'   => 'required',
            'deskripsi'     => 'required',
            'harga'         => 'required',
            'gambar'        => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $produk                 = new Produk();
        $produk->nama_produk    = $request->nama_produk;
        $produk->deskripsi      = htmlspecialchars($request->deskripsi);
        $produk->harga          = $request->harga;
        // total pajak = 10% dari harga
        $produk->total_pajak    = $request->harga * 0.1;

        $imageName = time().'.'.$request->gambar->extension();  
        $request->gambar->move(public_path('uploads'), $imageName);
        $produk->gambar         = $imageName;
        $produk->save();

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::find($id);
        $gambar_lama = $produk->gambar;
        $validated = $request->validate([
            'nama_produk'   => 'required',
            'deskripsi'     => 'required',
            'harga'         => 'required',
            'gambar'        => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
       
       if($validated){
            if($request->gambar != null){
                $produk->nama_produk    = $request->nama_produk;
                $produk->deskripsi      = htmlspecialchars($request->deskripsi);
                $produk->harga          = $request->harga;
                $produk->total_pajak    = $request->harga * 0.1;
                $imageName = time().'.'.$request->gambar->extension();  
                $request->gambar->move(public_path('uploads'), $imageName);
                $produk->gambar         = $imageName;
            }else{
                $produk->nama_produk    = $request->nama_produk;
                $produk->deskripsi      = htmlspecialchars($request->deskripsi);
                $produk->harga          = $request->harga;
                $produk->gambar         = $request->gambar_lama;
            }

            $success = $produk->update();
            if($success){
                return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil diubah');
            }else{
                return redirect()->route('admin.produk.index')->with('error', 'Opps! Terjadi kesalahan');
            }
       }else{
            return redirect()->route('admin.produk.index')->with('error', 'Opps! Terjadi kesalahan. Pastikan semua data terisi dengan benar!');
       }
    }

    public function destroy($id)
    {
        $produk = Produk::find($id);
        $produk->delete();
        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil dihapus');
    }

    // fungsi untuk menampilkan data client berdasarkan user_id yang sedang login
    public function myPackage()
    {
        $notifications = Notification::where('user_id', auth()->user()->id)->where('status', 'Unread')->get();  
        $package = Client::where('user_id', auth()->user()->id)->get();
        return view('client.my_package', compact('package', 'notifications'));
    }

    public function reqUpgrade()
    {
        $produks = Produk::all();
        $notifications = Notification::where('user_id', auth()->user()->id)->where('status', 'Unread')->get();  
        return view('client.produk_list', compact('produks', 'notifications'));
    }

    public function sendReqUpgrade($id)
    {
        // ambil data dari tabel prospek where user_id = auth()->user()->id
        $prospek = Prospek::where('user_id', auth()->user()->id)->first();
        
        $fullname = $prospek['fullname'];
        $email = $prospek['email'];
        $phone = $prospek['phone'];
        $address = $prospek['address'];
        $city = $prospek['city'];
        $province = $prospek['province'];
        $zip_code = $prospek['zip_code'];
        $identity_img = $prospek['identity_img'];

        $prospek = new Prospek();
        $prospek->produk_id     = $id;
        $prospek->user_id       = auth()->user()->id;
        $prospek->status_id     = 4;
        $prospek->fullname      = $fullname;
        $prospek->email         = $email;
        $prospek->phone         = $phone;
        $prospek->address       = $address;
        $prospek->city          = $city;
        $prospek->province      = $province;
        $prospek->zip_code      = $zip_code;
        $prospek->identity_img  = $identity_img;
        $prospek->save();
        return redirect()->back()->with('success', 'Permintaan anda berhasil terkirim');

    }
}
