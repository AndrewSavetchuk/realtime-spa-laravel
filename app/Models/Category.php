<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
  protected $fillable = ['title', 'slug'];

  public static function boot()
  {
    parent::boot();

    static::creating(function ($question) {
      $question->slug = Str::slug($question->title);
    });
  }

  function getRouteKeyName()
  {
    return 'slug';
  }
}
