<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    return view('posts.index')->with('posts', Post::orderBy('title', 'asc')->paginate(7));
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    return view('posts.create');
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
    Post::create([
      'title' => $request->title,
      'description' => $request->description,
      'content' => $request->content,
      'image' => $image
    ]);
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
    return view('posts.create')->with('post', $post);
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
    $data = $request->only(['title', 'description', 'content']);
    if ($request->hasFile('image')) {
      $image = $request->image->store('posts_image');
      $post->deleteImage();
      $data['image'] = $image;
    }

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
    $post->deleteImage();
    Session()->flash('success', 'ลบข้อมูลเรียบร้อย');
    return redirect(route('posts.index'));
  }
}
