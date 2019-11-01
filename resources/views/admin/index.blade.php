@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">
          <b>พิจารณาคำขอ</b> จำนวนรายการทั้งหมด  รายการ
          <a href="{{route('admin.create')}}" class="btn btn-primary btn-sm float-md-right "><i class="fa fa-plus"></i> &nbsp;เพิ่มผู้ดูแลระบบ</a>
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
                      <th class="text text-center" width="25%" style="vertical-align: middle;">วันที่ยื่นเรื่อง</th>
                      <th class="text text-center" style="vertical-align: middle;">ชื่อ</th>
                      <th class="text text-center" width="16%">ประเภท</th>
                      <th class="text text-center" width="22%" style="vertical-align: middle;">ดำเนินการ</th>
                    </tr>
                  </thead>
                  <tbody>

                    <tr>
                      <td class="text-center"></td>
                      <td></td>
                      <td class="text-left">-</td>
                      <td class="text-center"></td>
                      <td class="text-center">
                        <form class="delete_form" action="" method="post">
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
                  </tbody>
                </table>

                <!-- <table class="table table-bordered table-hover">
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
                </table> -->

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
    if (confirm('ไม่อนุมัติผู้ใช้งานใช่ไหม')) {
      return true;
    } else {
      return false;
    }
  })
})
</script>
@endsection
