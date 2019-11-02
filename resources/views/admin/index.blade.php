@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">
          <b>ตั้งค่าผู้ดูแลระบบ</b> จำนวนรายการทั้งหมด {{$admins->total()}} รายการ
          <a href="{{route('admin.create')}}" class="btn btn-success btn-sm float-md-right "><i class="fa fa-plus"></i> &nbsp;เพิ่มผู้ดูแลระบบ</a>
        </div>
        <div class="card-body">
          <div class="container">
            <div class="row">
              <div class="col-md-1">
              </div>
              <div class="col-md-10">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr style="background-color: #efefef; height: 50px; color: #555555;">
                      <th class="text text-center" width="3%" style="vertical-align: middle;">ลำดับ</th>
                      <th class="text text-center" style="vertical-align: middle;">ชื่อ</th>
                      <th class="text text-center" width="16%">สถานะ</th>
                      <th class="text text-center" width="17%" style="vertical-align: middle;">ดำเนินการ</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($admins as $admin)
                    <tr>
                      <td class="text-center">{{$rank++}}</td>
                      <td class="text-left">- {{$admin->name}}</td>
                      <td class="text-left"> &nbsp;{!!typeAdmin($admin->role_pending)!!} </td>
                      <td class="text-center">
                        <form class="delete_form" action="{{route('admin.destroy', $admin->id)}}" method="post">
                          @csrf
                          @method('put')
                          <a href="{{route('admin.edit', $admin->id)}}" class="btn btn-primary btn-sm">แก้ไข</a>
                          &nbsp;
                          @if (auth()->user()->id != $admin->id)
                          <input type="submit" name="" value="ลบ" class="btn btn-danger btn-sm">
                          @endif
                        </form>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="col-md-1">
              </div>
              <div class="col-md-1">
              </div>
              <div class="col-md-11">
                {{$admins->links()}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
  $('.delete_form').on('submit', function() {
    if (confirm('ต้องการลบผู้ดูแลระบบใช่ไหม')) {
      return true;
    } else {
      return false;
    }
  })
})
</script>
@endsection
