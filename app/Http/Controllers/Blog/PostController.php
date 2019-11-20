<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use App\User;
use DB;

class PostController extends Controller
{
  public function show(Post $post) {
    $comments = DB::table('post_user_comment as puc')
      ->leftJoin('users', 'puc.user_id', '=', 'users.id')
      ->select('puc.*', 'users.name')
      ->where('puc.post_id', '=', $post->id)
      ->orderBy('puc.created_at', 'asc')
      ->paginate(5);
    $rank = $comments->firstItem();
    $total = $comments->total();
    return view('blog.show', ['post' => $post, 'comments' => $comments, 'total' => $total, 'rank' => $rank]);
  }

  public function category(Category $category) {
    return view('blog.category')
    ->with('categories', Category::all())
    ->with('tags', Tag::all())
    ->with('category', $category)
    ->with('posts', $category->post()->paginate(2));
  }

  public function tag(Tag $tag) {
    return view('blog.tag')
    ->with('categories', Category::all())
    ->with('tags', Tag::all())
    ->with('tag', $tag)
    ->with('posts', $tag->post()->paginate(2));
  }

  public function showuser(User $user) {
    return view('blog.showuser')
    ->with('categories', Category::all())
    ->with('tags', Tag::all())
    ->with('user', $user)
    ->with('posts', $user->post()->paginate(2));
    dd($user->post()->get());
  }
}
