<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Prospek;
use App\Models\Notification;
class HomeController extends Controller
{
    public function admin()
    {
        $userTotal = User::count();
        $clientTotal = Client::count();
        $prospekTotal = Prospek::where('status_id', 1)->count();
        $paymentPaid = Invoice::where('status', 'Paid')->count();
        $paymentUnpaid = Invoice::where('status', 'Unpaid')->count();
        return view('admin.index', compact('userTotal', 'clientTotal', 'prospekTotal', 'paymentPaid', 'paymentUnpaid'));
    }

    public function guest()
    {
        $userTotal = User::count();
        $clientTotal = Client::count();
        $prospekTotal = Prospek::where('status_id', 1)->count();
        $paymentPaid = Invoice::where('status', 'Paid')->count();
        $paymentUnpaid = Invoice::where('status', 'Unpaid')->count();
        return view('guest.index', compact('userTotal', 'clientTotal', 'prospekTotal', 'paymentPaid', 'paymentUnpaid'));
    }
    public function client()
    {
        $userTotal = User::count();
        $clientTotal = Client::count();
        $prospekTotal = Prospek::where('status_id', 1)->count();
        $paymentPaid = Invoice::where('status', 'Paid')
        ->where('user_id', auth()->user()->id)->count();
        $paymentUnpaid = Invoice::where('status', 'Unpaid')
        ->where('user_id', auth()->user()->id)->count();
        $notifications = Notification::where('user_id', auth()->user()->id)->where('status', 'Unread')->get();
        return view('client.index', compact('userTotal', 'clientTotal', 'prospekTotal', 'paymentPaid', 'paymentUnpaid', 'notifications'));
    }
}
