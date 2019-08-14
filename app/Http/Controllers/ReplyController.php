<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReplyResource;
use App\Models\Question;
use App\Models\Reply;
use App\Notifications\NewReplyNotification;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReplyController extends Controller
{
  public function __construct()
  {
    $this->middleware('JWT', ['except' => ['index', 'show']]);
  }

  public function index(Question $question)
  {
    return ReplyResource::collection($question->replies()->latest()->get());
  }

  public function store(Question $question, Request $request)
  {
    $reply = $question->replies()->create($request->all());
    $user = $question->user;
    if ($reply->user_id !== $question->user_id) {
      $user->notify(new NewReplyNotification($reply));
    }
    return response(['reply' => new ReplyResource($reply)], Response::HTTP_CREATED);
  }

  public function show(Question $question, Reply $reply)
  {
    return new ReplyResource($reply);
  }

  public function update(Question $question, Request $request, Reply $reply)
  {
    $reply->update($request->all());
    return response(new ReplyResource($reply), Response::HTTP_OK);
  }

  public function destroy(Question $question, Reply $reply)
  {
    $reply->delete();
    return response(null, Response::HTTP_OK);
  }
}
