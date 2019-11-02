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
                <input type="email" class="form-control" name="email" value="{{isset($admin)?$admin->email:''}}" {{isset($admin)?'readonly':''}}>
              </div>
            </div>
            @if (!isset($admin))
              <div class="form-group row">
                <label for="" class="col-md-1 col-form-label"></label>
                <label for="" class="col-md-2 col-form-label text-md-right">รหัสผ่าน <span style="color:red;">*</span></label>
                <div class="col-md-6">
                  <input type="password" class="form-control" name="password" value="">
                </div>
              </div>
              <div class="form-group row">
                <label for="" class="col-md-1 col-form-label"></label>
                <label for="" class="col-md-2 col-form-label text-md-right">ยืนยันรหัสผ่าน <span style="color:red;">*</span></label>
                <div class="col-md-6">
                  <input type="password" class="form-control" name="password_confirmation" value="">
                </div>
              </div>
              <div class="form-group text-center">
                <input type="submit" name="" value="Submit" class="btn btn-success">
              </div>
            @else
            <div class="form-group row">
              <label for="" class="col-md-1 col-form-label"></label>
              <label for="" class="col-md-2 col-form-label text-md-right">ประเภท <span style="color:red;">*</span></label>
              <div class="col-md-6">
                <div class="radio" style="padding-top: 10px;">
                  <label><input type="radio" name="role" value="admin"
                    @if (isset($admin))
                      @if ($admin->role == 'admin')
                        checked
                      @endif
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
                  <label><input type="radio" name="status" value="approve"
                    @if (isset($admin))
                      @if ($admin->role_pending == 'admin')
                        checked
                      @endif
                    @endif
                    > ใช้งาน </label>&emsp;
                  <label><input type="radio" name="status" value="noapprove"
                    @if (isset($admin))
                      @if ($admin->role_pending == 'noapprove')
                        checked
                      @endif
                    @endif
                    > ไม่ใช้งาน </label>
                </div>
              </div>
            </div>
            <div class="form-group text-center">
              <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#Modalapprove">
                Submit
              </button>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="Modalapprove" tabindex="-1" role="dialog" aria-labelledby="Modalapprove" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="Modalapprove">กรุณาใส่รหัสผ่านเพื่อยืนยัน</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="form-group row">
                      <label for="" class="col-md-1 col-form-label"></label>
                      <label for="" class="col-md-3 col-form-label text-md-right">รหัสผ่าน <span style="color:red;">*</span></label>
                      <div class="col-md-6">
                        <input type="password" class="form-control" name="password" value="">
                      </div>
                    </div>
                      <div class="form-group row">
                        <label for="" class="col-md-1 col-form-label"></label>
                        <label for="" class="col-md-3 col-form-label text-md-right">ยืนยันรหัสผ่าน <span style="color:red;">*</span></label>
                        <div class="col-md-6">
                          <input type="password" class="form-control" name="password_confirmation" value="">
                        </div>
                      </div>
                  <div class="modal-footer">
                      <input type="submit" name="" value="Confirm" class="btn btn-success">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  </div>
                </div>
              </div>
            </div>
            @endif
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
