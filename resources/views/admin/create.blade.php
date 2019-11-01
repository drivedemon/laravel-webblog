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
          {{isset($admin)?'แก้ไขข้อมูลผู้ดูแลระบบ':'เพิ่มข้อมูลผู้ดูแลระบบ'}}
        </div>
        <div class="card-body">
          <form action="{{isset($admin)?route('admin.update', $admin->id):route('admin.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            @if (isset($admin))
              @method('put')
            @endif
            <input type="hidden" name="flag" value="_ADMIN">
            <div class="form-group row">
              <label for="" class="col-md-1 col-form-label"></label>
              <label for="" class="col-md-2 col-form-label text-md-right">ชื่อ - นามสกุล <span style="color:red;">*</span></label>
              <div class="col-md-6">
                <input type="text" class="form-control" name="name" value="{{isset($admin)?$admin->name:''}}">
              </div>
            </div>
            <div class="form-group row">
              <label for="" class="col-md-1 col-form-label"></label>
              <label for="" class="col-md-2 col-form-label text-md-right">E-mail <span style="color:red;">*</span></label>
              <div class="col-md-6">
                <input type="email" class="form-control" name="email" value="{{isset($admin)?$admin->email:''}}" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="" class="col-md-1 col-form-label"></label>
              <label for="" class="col-md-2 col-form-label text-md-right">ประเภท <span style="color:red;">*</span></label>
              <div class="col-md-6">
                <div class="radio" style="padding-top: 10px;">
                  <label><input type="radio" name="role" value="admin"
                    @if ($admin->role == 'admin')
                      checked
                    @endif
                    > Admin </label>&emsp;
                  <label><input type="radio" name="role" value="writer"
                    > Writer </label>&emsp;
                  <label><input type="radio" name="role" value="reader"
                    > Reader </label>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label for="" class="col-md-1 col-form-label"></label>
              <label for="" class="col-md-2 col-form-label text-md-right">สถานะ <span style="color:red;">*</span></label>
              <div class="col-md-6">
                <div class="radio" style="padding-top: 10px;">
                  <label><input type="radio" name="role_pick" value="approve"
                    @if ($admin->role_pending == 'admin')
                      checked
                    @endif
                    > ใช้งาน </label>&emsp;
                  <label><input type="radio" name="role_pick" value="noapprove"
                    @if ($admin->role_pending == 'noapprove')
                      checked
                    @endif
                    > ไม่ใช้งาน </label>
                </div>
              </div>
            </div>
            <div class="form-group text-center">
              <input type="submit" name="" value="Submit" class="btn btn-success">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
