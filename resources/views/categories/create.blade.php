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
          {{isset($category)?'แก้ไขประเภทบทความ':'เพิ่มประเภทบทความ'}}
        </div>
        <div class="card-body">
          <form action="{{isset($category)?route('categories.update', $category->id):route('categories.store')}}" method="post">
            @csrf
            @if(isset($category))
              @method('put')
            @endif
            <div class="form-group row">
                <label for="postname" class="col-md-1 col-form-label"></label>
                <label for="postname" class="col-md-2 col-form-label">ประเภทบทความ <span style="color:red;">*</span></label>
                <div class="col-md-7">
                  <input type="text" class="form-control" name="name" id="postname" value="{{isset($category)?$category->name:''}}">
                </div>
              </div>
            <div class="form-group text-center">
              <input type="submit" name="" value="{{isset($category)?'อัปเดตประเภทบทความ':'เพิ่มประเภทบทความ'}}" class="btn btn-success">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
