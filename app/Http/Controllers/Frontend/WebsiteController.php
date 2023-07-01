<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
class WebsiteController extends Controller
{
    public function index()
    {
        return view('website.welcome');
    }

    public function pricing()
    {
        $produks = Produk::all();
        return view('website.pricing', compact('produks'));
    }

    public function contact()
    {
        return view('website.contact');
    }
}
