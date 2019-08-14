<?php

namespace App\Http\Controllers;

use App\Models\Reply;

class LikeController extends Controller
{
  public function __construct()
  {
    $this->middleware('JWT');
  }

  public function like(Reply $reply)
  {
    $reply->likes()->create([
      'user_id' => auth()->user()->id,
    ]);
  }

  public function dislike(Reply $reply)
  {
    $reply->likes()->where('user_id', auth()->user()->id)->first()->delete();
  }
}
