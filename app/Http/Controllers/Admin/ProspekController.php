<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prospek;
use App\Models\Client;
use App\Models\User;
class ProspekController extends Controller
{
    public function index()
    {
        //ambil data prospek where status_id = 1 & 4
        $prospeks = Prospek::where('status_id', 1)->get();
        return view('admin.prospek', compact('prospeks'));
    }
    public function upgrade()
    {
        //ambil data prospek where status_id = 1 & 4
        $prospeks = Prospek::where('status_id', 4)->get();
        return view('admin.upgrade', compact('prospeks'));
    }

    public function convert_to_client(Request $request, $id)
    {
        $prospek    = Prospek::find($id);
        $id         = $prospek->user_id;
      
        $user = new User();
        $user       = User::find($id);
        $user->role = 'client';
        $update     = $user->update();
        
        if($update){
            //cek apakah client sudah tersedia di table client, jika belum maka buat baru
            $client = Client::where('user_id', $id)->first();
            if($client == null){
                $client             = new Client();
                $client->added_from = $prospek->id;
                $client->produk_id  = $prospek->produk_id;
                $client->user_id    = $prospek->user_id;
                $client->fullname   = $request->fullname;
                $client->email      = $request->email;
                $client->phone      = $request->phone;
                $client->address    = $request->address;
                $client->city       = $request->city;
                $client->province   = $request->province;
                $client->zip_code   = $request->zip_code;
                $client->exp_date   = date('Y-m-d', strtotime('+1 month', strtotime(date('Y-m-d'))) );
                $client->save();
            }else{
                //jika sudah ada maka update produk_id saja
                $client->produk_id  = $request->prod_id;
                $client->update();
            }
            $prospek->status_id = 2;
            $prospek->update();
            return redirect()->back()->with('success', 'Prospek berhasil di konversi menjadi client');
        }else{
            return redirect()->back()->with('error', 'Prospek gagal di konversi menjadi client');
        }
    }
}
