<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuestionResource;
use App\Http\Requests\QuestionRequest;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class QuestionController extends Controller
{
  public function __construct()
  {
    $this->middleware('JWT', ['except' => ['index', 'show']]);
  }

  public function index()
  {
    return QuestionResource::collection(Question::latest()->get());
  }

  public function store(QuestionRequest $request)
  {
    $question = auth()->user()->questions()->create($request->all());
    return response(new QuestionResource($question), Response::HTTP_CREATED);
  }

  public function show(Question $question)
  {
    return new QuestionResource($question);
  }

  public function update(QuestionRequest $request, Question $question)
  {
    $question->update($request->all());
    return response(new QuestionResource($question), Response::HTTP_OK);
  }

  public function destroy(Question $question)
  {
    $question->delete();
    return response(null, Response::HTTP_OK);
  }
}
