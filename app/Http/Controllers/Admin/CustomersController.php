<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
class CustomersController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return view('admin.customers', compact('clients'));
    }

    public function do_disable(Request $request, $id)
    {
        $client             = Client::find($id);
        //cek apakah status client aktif atau tidak, jika aktif maka akan di disable
        if($client->status == 'Active'){
            $client->status = 'Inactive';
            $client->save();
            return redirect()->back()->with('success', 'Status berhasil diubah');
        }else{
            $client->status = 'Active';
            $client->save();
            return redirect()->back()->with('success', 'Status berhasil diubah');
        }
    }
}
