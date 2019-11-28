<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Category;
use App\Post;
use DB;

class WelcomeController extends Controller
{
  public function index() {
    $search = request()->query('search');
    if ($search) {
      $post = Post::where('title', 'like', '%'.$search.'%')->paginate(2);
    } else {
      $post = Post::paginate(4);
    }
    return view('welcome')
    ->with('categories', Category::all())
    ->with('tags', Tag::all())
    ->with('posts', $post);
  }
}
