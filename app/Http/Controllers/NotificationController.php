<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
  public function index()
  {
    return [
      'read'   => auth()->user() ? auth()->user()->readNotifications : [],
      'unread' => auth()->user() ? auth()->user()->unreadNotifications : [],
    ];
  }

  public function markAsRead(Request $request)
  {
     auth()->user()->notifications->where('id', $request->id)->markAsRead();
  }
}
