@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      @if($errors->any())
      <div class="alert alert-danger">
        <ul class="list-group">
          @foreach($errors->all() as $error)
          <li class="list-group-item">{{$error}}</li>
          @endforeach
        </ul>
      </div>
      @endif
      <div class="card">
        <div class="card-header">
          {{isset($tag)?'แก้ไขแท็ก':'เพิ่มแท็ก'}}
        </div>
        <div class="card-body">
          <form action="{{isset($tag)?route('tags.update', $tag->id):route('tags.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            @if(isset($tag))
            @method('put')
            @endif
            <div class="form-group row">
              <label for="" class="col-md-1 col-form-label"></label>
              <label for="" class="col-md-2 col-form-label">ชื่อแท็ก <span style="color:red;">*</span></label>
              <div class="col-md-7">
                <input type="text" class="form-control" name="title" id="" value="{{isset($tag)?$tag->title:''}}">
              </div>
            </div>
            <div class="form-group text-center">
              <input type="submit" name="" value="{{isset($tag)?'อัปเดตแท็ก':'เพิ่มแท็ก'}}" class="btn btn-success">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
