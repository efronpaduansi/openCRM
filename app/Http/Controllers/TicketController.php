<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Notification;
class TicketController extends Controller
{
    public function index()
    {
        $pengaduan = Pengaduan::all();
        $notifications = Notification::where('user_id', auth()->user()->id)->where('status', 'Unread')->get();
        return view('client.pengaduan', compact('pengaduan', 'notifications'));
    }

    public function create()
    {
        $notifications = Notification::where('user_id', auth()->user()->id)->where('status', 'Unread')->get();
        return view('client.pengaduan_create', compact('notifications'));
    }

    public function store(Request $request)
    {
        $validated = request()->validate([
            'topik'         => 'required',
            'deskripsi'     => 'required',
            'status'        => 'required',
        ]);
        if($validated){
            $pengaduan              = new Pengaduan();
            $pengaduan->no          = "TC-" . rand(100000, 999999);
            $pengaduan->user_id     = $request->user_id;
            $pengaduan->topik       = $request->topik;
            $pengaduan->deskripsi   = $request->deskripsi;
            $pengaduan->status      = $request->status;
            if($pengaduan->save()){
                return redirect()->route('pengaduan.index')->with('success', 'Tiket anda berhasil terkirim!');
            }else{
                return false;
            }
        }
    }

    public function show($no)
    {
        $pengaduan = Pengaduan::where('no', $no)->first();
        $notifications = Notification::where('user_id', auth()->user()->id)->where('status', 'Unread')->get();
        return view('client.pengaduan_show', compact('pengaduan', 'notifications'));
    }
}
