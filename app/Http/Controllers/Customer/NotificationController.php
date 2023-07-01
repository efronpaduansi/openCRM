<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
class NotificationController extends Controller
{
    public function showAll()
    {
        $allNotif = Notification::where('user_id', auth()->user()->id)->get();
        $notifications = Notification::where('user_id', auth()->user()->id)
        ->where('status', 'Unread')
        ->get();
        return view('client.notifications', compact('notifications', 'allNotif'));
    }

    public function showById($id)
    {
        $allNotif = Notification::where('user_id', auth()->user()->id)->get();
        $notifications = Notification::where('user_id', auth()->user()->id)
        ->where('status', 'Unread')->get();
        $notification = Notification::where('user_id', auth()->user()->id)
        ->where('id', $id)->get()->first();
        $this->_updateStatus($id);
        return view('client.notifications', compact('notifications', 'notification', 'allNotif'));
    }

    private function _updateStatus($id)
    {
        $notification = Notification::where('user_id', auth()->user()->id)
        ->where('id', $id)
        ->where('status', 'Unread')->get()->first();
        $notification->status = 'Read';
        $notification->save();
    }
}
