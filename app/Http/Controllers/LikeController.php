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
      // 'user_id' => auth()->id(), // TODO: implement auth later
      'user_id' => 1,
    ]);
  }

  public function dislike(Reply $reply)
  {
    // $reply->likes()->where('user_id', auth()->id())->first()->delete(); // TODO: implement auth later
    $reply->likes()->where('user_id', 1)->first()->delete();
  }
}
