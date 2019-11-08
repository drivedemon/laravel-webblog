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
          <b>แก้ไขข้อมูล</b> คุณ {{$user->name}}
        </div>
        <div class="card-body">
          <form action="{{route('user.update', $user->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @if(isset($user))
            @method('put')
            @endif
            <div class="form-group row">
              <label for="" class="col-md-2 col-form-label"></label>
              <label for="" class="col-md-2 col-form-label text-md-right">ชื่อ - นามสกุล</label>
              <div class="col-md-5">
                <input type="text" class="form-control" name="name" value="{{isset($user)?$user->name:''}}">
              </div>
            </div>
            <div class="form-group row">
              <label for="" class="col-md-2 col-form-label"></label>
              <label for="" class="col-md-2 col-form-label text-md-right">Email</label>
              <div class="col-md-5">
                <input type="email" class="form-control" name="email" value="{{isset($user)?$user->email:''}}" readonly disabled>
              </div>
            </div>
            <div class="form-group row">
              <label for="" class="col-md-2 col-form-label"></label>
              <label for="" class="col-md-2 col-form-label text-md-right">ประเภท</label>
              <div class="col-md-5" style="padding-top: 8px;">
              @if(auth()->user()->isAdmin())
                Admin
              @else
                {{convertTypeName($user->role_pending, $user->role, 1)}}
              @endif
              </div>
            </div>
            <div class="form-group row">
              <label for="" class="col-md-2 col-form-label"></label>
              <label for="" class="col-md-2 col-form-label text-md-right">สถานะ</label>
              <div class="col-md-5" style="padding-top: 8px;">
                {!!convertTypeName($user->role, $user->role_pending, 2)!!}
              </div>
            </div>
            <div class="form-group row">
              <label for="" class="col-md-2 col-form-label"></label>
              <label for="" class="col-md-2 col-form-label text-md-right">วันที่ยื่นคำขอ</label>
              <div class="col-md-5" style="padding-top: 8px;">
                <label for="">{{DateThai($user->created_at)}}</label>
              </div>
            </div>
            <div class="form-group text-center">
              <input type="submit" name="" value="อัปเดตข้อมูล" class="btn btn-success">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
