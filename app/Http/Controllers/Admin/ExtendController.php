<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Notification;
use App\Models\Extend;
use App\Models\Invoice;
class ExtendController extends Controller
{
    public function index()
    {
        $notifications  = Notification::where('user_id', auth()->user()->id)->where('status', 'Unread')->get();
        $clients        = Client::where('status', 'Active')->get();
        $extend         = Extend::where('user_id', auth()->user()->id)->where('status', 'Unread')->first();
        return view('admin.extend_client', compact('clients', 'notifications', 'extend'));
    }

    public function send(Request $request)
    {
        $client         = Client::find($request->client_id);

        //simpan ke tabel extends
        $extend             = new Extend();
        $extend->user_id    = $client->user_id;
        $extend->title      = "Informasi Perpanjangan Langganan";
        $extend->message    = "Kepada pelanggan yang terhormat, kami ingin memberitahukan bahwa akun anda akan segera berakhir pada tanggal " . $client->exp_date . ". Silahkan melakukan konfirmasi perpanjangan berlangganan melalui tombol dibawah ini dan segera melakukan pembayaran agar layanan Anda tetap berjalan. Terima kasih.";
        $extend->status    = "Unread";
        $extend->save();
        return redirect()->route('extend.index')->with('success', 'Pesan berhasil terkirim!');
    }

    public function update(Request $request)
    {
        $extend         = Extend::find($request->extend_id);
        $extend->status = "Read";
        $extend->update();
        //ambil exp_date dari client  where user_id = auth user id
        $client         = Client::where('user_id', auth()->user()->id)->first();
        
        $client->exp_date = date('Y-m-d', strtotime('+1 month', strtotime($client->exp_date)) );
        $client->update();

        return redirect()->route('extend.index')->with('success', 'Terima kasih anda telah mengkonfirmasi!');
    }

    public function reject(Request $request)
    {
        $extend         = Extend::find($request->extend_id);
        $extend->status = "Read";
        $extend->update();

        $client         = Client::where('user_id', auth()->user()->id)->first();
        $client->status = "Inactive";
        $client->update();
        return redirect()->route('extend.index')->with('error', 'Anda telah mengkonfirmasi bahwa anda akan berhenti berlangganan! Sampai jumpa!');
    }
}
