@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">
          <b>พิจารณาคำขอ</b> จำนวนรายการทั้งหมด {{$users->total()}} รายการ
        </div>
        <div class="card-body">
          <div class="container">
            <div class="row">
              <div class="col-md-1">
              </div>
              <div class="col-md-10">
                @if ($users->count() > 0)
                <div class="table-responsive-sm">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr style="background-color: #efefef; height: 50px; color: #555555;">
                      <th class="text text-center" width="3%" style="vertical-align: middle;">ลำดับ</th>
                      <th class="text text-center" width="25%" style="vertical-align: middle;">วันที่ยื่นเรื่อง</th>
                      <th class="text text-center" style="vertical-align: middle;">ชื่อ</th>
                      <th class="text text-center" width="16%">ประเภท</th>
                      <th class="text text-center" width="22%" style="vertical-align: middle;">ดำเนินการ</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($users as $key => $user)
                    <tr>
                      <td class="text-center">{{$rank++}}</td>
                      <td>{{DateThai($user->created_at)}}</td>
                      <td class="text-left">- {{$user->name}}</td>
                      <td class="text-center">{{convertTypeName($user->role_pending, null, 1)}}</td>
                      <td class="text-center">
                        <form class="delete_form" action="{{route('users.noapprove', $user->id)}}" method="post">
                          @csrf
                          @method('put')
                          <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#Modalapprove{{$key}}">
                            อนุมัติ
                          </button>
                          &nbsp;
                          <input type="submit" name="" value="ไม่อนุมัติ" class="btn btn-danger btn-sm">
                        </form>
                      </td>
                    </tr>
                    <!-- Modal -->
                    <div class="modal fade" id="Modalapprove{{$key}}" tabindex="-1" role="dialog" aria-labelledby="Modalapprove{{$key}}" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="Modalapprove">รายละเอียดคำขอลงทะเบียน</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="form-group row">
                              <div class="col-md-1"></div>
                              <div class="col-md-3">
                                <b>ชื่อ :</b>
                              </div>
                              <div class="col-md-7">
                                {{$user->name}}
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="col-md-1"></div>
                              <div class="col-md-3">
                                <b>Email :</b>
                              </div>
                              <div class="col-md-7">
                                {{$user->email}}
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="col-md-1"></div>
                              <div class="col-md-3">
                                <b>วันที่ยื่นเรื่อง :</b>
                              </div>
                              <div class="col-md-7">
                                {{DateThai($user->created_at)}}
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="col-md-1"></div>
                              <div class="col-md-3">
                                <b>ประเภท :</b>
                              </div>
                              <div class="col-md-7">
                                {{convertTypeName($user->role_pending, null, 1)}}
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="col-md-1"></div>
                              <div class="col-md-3">
                                <b>สถานะ :</b>
                              </div>
                              <div class="col-md-7">
                                {!!convertTypeName($user->role, null, 2)!!}
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <form action="{{route('users.approve', $user->id)}}" method="post" enctype="multipart/form-data">
                              @csrf
                              @method('put')
                              <input type="hidden" name="role" value="{{$user->role_pending}}">
                              <input type="submit" name="" value="อนุมัติ" class="btn btn-success">
                            </form>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    @endforeach
                  </tbody>
                </table>
              </div>
                @else
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr style="background-color: #efefef; height: 50px; color: #555555;">
                      <th>คำขอ</th>
                    </tr>
                  </thead>
                  <tbody>
                    <th class="text-center">
                      ไม่มีคำขอ
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
                {{$users->links()}}
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
    if (confirm('ไม่อนุมัติผู้ใช้งานใช่ไหม')) {
      return true;
    } else {
      return false;
    }
  })
})
</script>
@endsection
