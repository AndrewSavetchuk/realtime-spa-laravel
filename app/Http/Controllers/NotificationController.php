<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
  public function __construct()
  {
    $this->middleware('JWT', ['except' => ['index', 'show']]);
  }

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
