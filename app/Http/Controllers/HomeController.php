<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
  /**
  * Create a new controller instance.
  *
  * @return void
  */
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
  * Show the application dashboard.
  *
  * @return \Illuminate\Contracts\Support\Renderable
  */
  public function index()
  {
    $topics = DB::table('post_user_comment as pc')
      ->leftJoin('posts', 'posts.id', '=', 'pc.post_id')
      ->select('posts.title', 'posts.description', 'posts.image', 'pc.post_id', DB::raw('COUNT(pc.user_id) as ccomment'))
      ->groupBy('pc.post_id', 'posts.title', 'posts.description', 'posts.image')
      ->orderBy('ccomment', 'desc')
      ->limit(5)
      ->get();
    $tags = DB::table('tags')
      ->leftJoin('post_tag', 'tags.id', '=', 'post_tag.tag_id')
      ->select('tags.id', 'tags.name', DB::raw('COUNT(post_tag.tag_id) as count_data'))
      ->groupBy('tags.id', 'tags.name')
      ->orderBy('count_data', 'desc')
      ->limit(5)
      ->get();
    $categories = DB::table('categories')
      ->leftJoin('posts', 'categories.id', '=', 'posts.category_id')
      ->select('categories.id', 'categories.name', DB::raw('COUNT(posts.category_id) as count_data'))
      ->groupBy('categories.id', 'categories.name')
      ->orderBy('count_data', 'desc')
      ->limit(5)
      ->get();
    $topics_total = $topics->count();
    return view('home', ['topics' => $topics, 't_topic' => $topics_total, 'tags' => $tags, 'categories' => $categories]);
  }
}
