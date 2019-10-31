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
          <form action="{{route('users.update', $user->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @if(isset($user))
            @method('put')
            @endif
            <div class="form-group row">
              <label for="" class="col-md-2 col-form-label"></label>
              <label for="" class="col-md-2 col-form-label">ชื่อ <span style="color:red;">*</span></label>
              <div class="col-md-5">
                <input type="text" class="form-control" name="name" value="{{isset($user)?$user->name:''}}">
              </div>
            </div>
            <div class="form-group row">
              <label for="" class="col-md-2 col-form-label"></label>
              <label for="" class="col-md-2 col-form-label">Email <span style="color:red;">*</span></label>
              <div class="col-md-5">
                <input type="email" class="form-control" name="email" value="{{isset($user)?$user->email:''}}" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="" class="col-md-2 col-form-label"></label>
              <label for="" class="col-md-2 col-form-label">ประเภท <span style="color:red;">*</span></label>
              <div class="col-md-5">
                <div class="radio" style="padding-top: 10px;">
                  <label><input type="radio" name="role" value="writer"
                    @if($user->role == 'writer' || $user->role_pending == 'writer')
                      checked
                    @endif
                    > Writer </label>&emsp;
                  <label><input type="radio" name="role" value="reader"
                    @if($user->role == 'reader' || $user->role_pending == 'reader')
                      checked
                    @endif
                    > Reader </label>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label for="" class="col-md-2 col-form-label"></label>
              <label for="" class="col-md-2 col-form-label">สถานะ <span style="color:red;">*</span></label>
              <div class="col-md-5">
                <div class="radio" style="padding-top: 10px;">
                  <label><input type="radio" name="status" value="approve"
                    @if ($user->role_pending == 'approve')
                      checked
                    @endif
                    > อนุมัติ </label>&emsp;
                  <label><input type="radio" name="status" value="role_pick"
                    @if ($user->role_pending != 'approve')
                      checked
                    @endif> รออนุมัติ </label>&emsp;
                  <label><input type="radio" name="status" value="noapprove"
                    @if ($user->role_pending == 'noapprove')
                      checked
                    @endif> ไม่อนุมัติ </label>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label for="" class="col-md-2 col-form-label"></label>
              <label for="" class="col-md-2 col-form-label">วันที่ยื่นคำขอ</label>
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
