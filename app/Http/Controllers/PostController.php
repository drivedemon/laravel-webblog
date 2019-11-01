<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use App\Http\Middleware\VerifyCategory;
use App\Http\Middleware\VerifymyPost;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function __construct() {
    $this->middleware('verifyCategory')->only(['index', 'create', 'store']);
    $this->middleware('mypost')->only('edit');
  }


  public function index()
  {
    if (auth()->user()->Permission()) {
      $results = Post::orderBy('title', 'asc')->paginate(10);
    } else {
      $results = Post::where('user_id', auth()->user()->id)->orderBy('title', 'asc')->paginate(10);
    }
    session()->push('flag', '0');
    return view('posts.index')->with('posts', $results);
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    return view('posts.create')->with('categories', Category::orderBy('name', 'asc')->get())->with('tags', Tag::all());
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(CreatePostRequest $request)
  {
    $image = $request->image->store('posts_image');
    $post = Post::create([
      'title' => $request->title,
      'description' => $request->description,
      'content' => $request->content,
      'image' => $image,
      'category_id'=> $request->category,
      'user_id' => auth()->user()->id
    ]);
      $post->tag()->attach($request->tags);

    Session()->flash('success', 'บันทึกข้อมูลเรียบร้อย');
    return redirect(route('posts.index'));
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    //
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit(Post $post)
  {
    return view('posts.create')->with('post', $post)->with('categories', Category::all())->with('tags', Tag::all());
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(UpdatePostRequest $request, Post $post)
  {
    $data = $request->only(['title', 'description', 'content', 'category']);
    if ($request->hasFile('image')) {
      $image = $request->image->store('posts_image');
      $post->deleteImage();
      $data['image'] = $image;
    }
      $post->tag()->sync($request->tags);

    $post->update($data);
    Session()->flash('success', 'อัปเดตข้อมูลเรียบร้อย');
    return redirect(route('posts.index'));
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy(Post $post)
  {
    $post->delete();
    $post->tag()->detach($post->post_id);
    $post->deleteImage();
    Session()->flash('success', 'ลบข้อมูลเรียบร้อย');
    return redirect(route('posts.index'));
  }
}
