<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengaduan;
class TicketController extends Controller
{
    public function index()
    {
        $tickets = Pengaduan::all();
        return view('admin.ticket', compact('tickets'));
    }
}
