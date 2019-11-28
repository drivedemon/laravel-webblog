@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      @if (session('status'))
      <div class="alert alert-success" role="alert">
        {{ session('status') }}
      </div>
      @endif
      @if (auth()->user()->Dashboard())
        @if ($topics)
        <div class="card">
          <div class="card-header font-weight-bold graybg"><center>TOP 5 Trend post</center></div>
        </div>
        <center>
          <div id="demo" class="carousel slide" data-ride="carousel">
            <ul class="carousel-indicators">
              @for ($i = 0; $i < $t_topic; $i++)
              <li data-target="#demo" data-slide-to="{{$i}}" {{($i==0)?'class=active':''}}></li>
              @endfor
            </ul>
            <div class="carousel-inner">
              @foreach($topics as $key => $topic)
              <div class="carousel-item {{($key==0)?'active':''}}">
                <a href="{{route('blog.show', $topic->post_id)}}"><img src="../storage/{{$topic->image}}" alt="Los Angeles" class="image"></a>
                <center>
                  <div class="carousel-caption overlay">
                    <a href="{{route('blog.show', $topic->post_id)}}" style="text-decoration:none; color:white;">
                      <h3><b>{{$topic->title}}</b></h3>
                      <p>{{$topic->description}}</p>
                    </a>
                  </div>
                </center>
              </div>
              @endforeach
              <a class="carousel-control-prev" href="#demo" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
              </a>
              <a class="carousel-control-next" href="#demo" data-slide="next">
                <span class="carousel-control-next-icon"></span>
              </a>
            </div>
          </center>
          <br>
          @endif
        @endif
        <div class="card">
          <div class="card-header font-weight-bold">Dashboard</div>
          <div class="card-body">
            @if (auth()->user()->Dashboard())
            <div class="containner row">
            <div class="col-md-1"></div>
              <div class="col-md-5">
                <div class="card">
                  <div class="card-header font-weight-bold graybg">TOP 5 of Tag</div>
                  <div class="card-body grayspace_bg">
                    @foreach($tags as $tag)
                      <a href="{{route('blog.tag', $tag->id)}}" style="text-decoration:none; color:black;">{{$tag->name}}</a>
                      <div class="float-right"><small style="color:gray;">ใช้งาน :</small> <a href="{{route('blog.tag', $tag->id)}}" style="text-decoration:none; color:black;">{{$tag->count_data}}</a>
                      </div>
                      <br>
                    @endforeach
                  </div>
                </div>
              </div>
                <div class="col-md-5">
                  <div class="card">
                    <div class="card-header font-weight-bold graybg">TOP 5 of Category</div>
                    <div class="card-body grayspace_bg">
                      @foreach($categories as $category)
                        <a href="{{route('blog.category', $category->id)}}" style="text-decoration:none; color:black;">{{$category->name}}</a>
                        <div class="float-right"><small style="color:gray;">ใช้งาน :</small> <a href="{{route('blog.category', $category->id)}}" style="text-decoration:none; color:black;">{{$category->count_data}}</a>
                        </div>
                        <br>
                      @endforeach
                    </div>
                  </div>
                </div>
            </div>
            @else
              Status : Pending for approve
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection
