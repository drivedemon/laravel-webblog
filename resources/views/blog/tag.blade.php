@extends('layouts.blog')
  @section('title')
    <title>Tag : Web-blog</title>
  @endsection
  @section('header')
    <header class="header text-center text-white" style="background-image: url('../../img/bg1.jpg');" data-overlay="9">
      <div class="container">
        <div class="row">
          <div class="col-md-8 mx-auto">
            <h1>Tag : {{$tag->name}}</h1>
          </div>
        </div>
      </div>
    </header>
  @endsection
  @section('content')
  <main class="main-content">
    <div class="section bg-gray">
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-xl-9">
            <div class="row gap-y">
              @forelse ($posts as $post)
              <div class="col-md-6">
                <div class="card border hover-shadow-6 mb-6 d-block">
                  <a href="{{route('blog.show', $post->id)}}"><img class="card-img-top" src="../../storage/{{$post->image}}" style="width:100%; height:250px;" alt="Card image cap"></a>
                  <div class="p-6 text-center">
                    <p><a class="small-5 text-lighter text-uppercase ls-2 fw-400" href="{{route('blog.show', $post->id)}}">{{$post->category->name}}</a></p>
                    <h5 class="mb-0"><a class="text-dark" href="{{route('blog.show', $post->id)}}">{{$post->title}}</a></h5>
                  </div>
                </div>
              </div>
              @empty
                <p class="text text-center">ไม่พบข้อมูลที่ค้นหา : <strong>{{$tag->name}}</strong></p>
              @endforelse
            </div>
            {{$posts->links()}}
          </div>
          @include('layouts.sidebar')
        </div>
      </div>
    </div>
  </main>
  @endsection
