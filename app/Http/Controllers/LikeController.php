<?php

namespace App\Http\Controllers;

use App\Events\LikeEvent;
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

    broadcast(new LikeEvent($reply->id, 1))->toOthers();
  }

  public function dislike(Reply $reply)
  {
    $reply->likes()->where('user_id', auth()->user()->id)->first()->delete();

    broadcast(new LikeEvent($reply->id, 0))->toOthers();
  }
}
