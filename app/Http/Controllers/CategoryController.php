<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
  public function index()
  {
    return Category::latest()->get();
  }

  public function store(Request $request)
  {
    Category::create($request->all());
    return response('Created', Response::HTTP_CREATED);
  }

  public function show(Category $category)
  {
    return $category;
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
