<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReplyResource extends JsonResource
{
  public static function isLiked($likes) {
    if (auth()->user()) {
      return !! $likes->where('user_id', auth()->user()->id)->count();
    } else {
      return false;
    }
  }

  public function toArray($request)
  {
    return [
      'id'          => $this->id,
      'body'        => $this->body,
      'user'        => $this->user->name,
      'user_id'     => $this->user_id,
      'likes_count' => $this->likes()->count(),
      'liked'       => self::isLiked($this->likes()),
      'created_at'  => $this->created_at->diffForHumans(),
    ];
  }
}
