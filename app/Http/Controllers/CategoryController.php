<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
  public function __construct()
  {
    $this->middleware('JWT', ['except' => ['index', 'show']]);
  }

  public function index()
  {
    return CategoryResource::collection(Category::latest()->get());
  }

  public function store(Request $request)
  {
    $category = Category::create($request->all());
    return response(new CategoryResource($category), Response::HTTP_CREATED);
  }

  public function show(Category $category)
  {
    return new CategoryResource($category);
  }

  public function update(Request $request, Category $category)
  {
    $category->update($request->all());
    return response('Updated', Response::HTTP_OK);
  }

  public function destroy(Category $category)
  {
    $category->delete();
    return response(null, Response::HTTP_OK);
  }
}
