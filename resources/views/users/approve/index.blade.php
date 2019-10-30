@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">
          จำนวนรายการทั้งหมด {{$users->total()}} รายการ
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
                      <th class="text text-center" width="25%" style="vertical-align: middle;">วันที่ยื่นเรื่อง</th>
                      <th class="text text-center" style="vertical-align: middle;">ชื่อ</th>
                      <th class="text text-center" width="15%">ประเภทที่ต้องการ</th>
                      <th class="text text-center" width="23%" style="vertical-align: middle;">ดำเนินการ</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($users as $user)
                    <tr>
                      <td>{{DateThai($user->created_at)}}</td>
                      <td class="text-left">- {{$user->name}}</td>
                      <td class="text-center">{{$user->role_pending}}</td>
                      <td class="text-center">
                        <form class="delete_form" action="{{route('users.noapprove', $user->id)}}" method="post">
                          @csrf
                          @method('put')
                          <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#Modalapprove">
                            อนุมัติ
                          </button>
                          &nbsp;
                          <input type="submit" name="" value="ไม่อนุมัติ" class="btn btn-danger btn-sm">
                        </form>
                      </td>
                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="Modalapprove" tabindex="-1" role="dialog" aria-labelledby="Modalapprove" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">รายละเอียดคำขอลงทะเบียน</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="form-group row">
                              <div class="col-md-1"></div>
                              <div class="col-md-3">
                                ชื่อ :
                              </div>
                              <div class="col-md-7">
                                {{$user->name}}
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="col-md-1"></div>
                              <div class="col-md-3">
                                Email :
                              </div>
                              <div class="col-md-7">
                                {{$user->email}}
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="col-md-1"></div>
                              <div class="col-md-3">
                                วันที่ยื่นเรื่อง :
                              </div>
                              <div class="col-md-7">
                                {{DateThai($user->created_at)}}
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="col-md-1"></div>
                              <div class="col-md-3">
                                ประเภท :
                              </div>
                              <div class="col-md-7">
                                {{$user->role_pending}}
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="col-md-1"></div>
                              <div class="col-md-3">
                                สถานะ :
                              </div>
                              <div class="col-md-7">
                                {{$user->role}}
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                            <form action="{{route('users.approve', $user->id)}}" method="post" enctype="multipart/form-data">
                              @csrf
                              @method('put')
                              <input type="hidden" name="role" value="{{$user->role_pending}}">
                              <input type="submit" name="" value="อนุมัติ" class="btn btn-success">
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    @endforeach
                  </tbody>
                </table>

                <!-- <table class="table table-bordered table-hover">
                <thead>
                <tr style="background-color: #efefef; height: 50px; color: #555555;">
                <th>แท็ก</th>
              </tr>
            </thead>
            <tbody>
            <th class="text-center">
            ไม่มีแท็ก
          </th>
        </tbody>
      </table> -->

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
    if (confirm('ต้องการลบข้อมูลใช่ไหม')) {
      return true;
    } else {
      return false;
    }
  })
})
</script>
@endsection
