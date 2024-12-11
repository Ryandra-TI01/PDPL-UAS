<?php

namespace App\Http\Controllers;

use App\Models\Notifications;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;

class NotificationController extends Controller
{
    public function markAsRead($id)
    {
        $notification = Notifications::findOrFail($id);
        $notification->update(['is_read'=>true]);

        return response()->json(['success' => true]);
    }
}
