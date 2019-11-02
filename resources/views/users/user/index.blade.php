@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">
          <b>ตั้งค่าผู้ใช้งาน</b> จำนวนรายการทั้งหมด {{$users->total()}} รายการ
        </div>
        <div class="card-body">
          <div class="container">
            <div class="row">
              <div class="col-md-1">
              </div>
              <div class="col-md-10">
                @if ($users->count() > 0)
                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr style="background-color: #efefef; height: 50px; color: #555555;">
                        <th class="text text-center" width="5%" style="vertical-align: middle;">ลำดับ</th>
                        <th class="text text-center" style="vertical-align: middle;">ชื่อ</th>
                        <th class="text text-center" width="16%">ประเภท</th>
                        <th class="text text-center" width="15%" style="vertical-align: middle;">สถานะ</th>
                        <th class="text text-center" width="17%" style="vertical-align: middle;">ดำเนินการ</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($users as $user)
                      <tr>
                        <td class="text-center">{{$rank++}}</td>
                        <td class="text-left">- {{$user->name}}</td>
                        <td class="text-center">{{convertTypeName($user->role_pending, $user->role, 1)}}</td>
                        <td>{!!convertTypeName($user->role, $user->role_pending, 2)!!}</td>
                        <td class="text-center">
                          <form class="delete_form" action="{{route('users.delete', $user->id)}}" method="post">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <a href="{{route('users.edit', $user->id)}}" class="btn btn-primary btn-sm" title="แก้ไขข้อมูลผู้ใช้งาน">แก้ไข</a>
                            &nbsp;
                            <input type="submit" name="" value="ลบ" title="ลบผู้ใช้งาน" class="btn btn-danger btn-sm">
                          </form>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                @else
                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr style="background-color: #efefef; height: 50px; color: #555555;">
                        <th>คำขอ</th>
                      </tr>
                    </thead>
                    <tbody>
                      <th class="text-center">
                        ไม่มีข้อมูล
                      </th>
                    </tbody>
                  </table>
                @endif
              </div>
              <div class="col-md-1">
              </div>
              <div class="col-md-1">
              </div>
              <div class="col-md-11">

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
    if (confirm('ต้องการลบผู้ใช้งานใช่ไหม\nหากลบแล้วข้อมูลผู้ใช้งานท่านนี้จะหายไปจากระบบทันที !!')) {
      return true;
    } else {
      return false;
    }
  })
})
</script>
@endsection
