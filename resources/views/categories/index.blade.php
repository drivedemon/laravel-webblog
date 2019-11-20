@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">
          จำนวนรายการทั้งหมด <span id="total"></span> รายการ
          <a href="{{route('categories.create')}}" class="btn btn-success btn-sm float-md-right "><i class="fa fa-plus"></i> &nbsp;เพิ่มประเภทบทความ</a>
        </div>
        <div class="card-body">
          <div class="container">
            @include('ajax.search')
            <div class="row">
              <div class="col-md-1">
              </div>
              <div class="col-md-10">
                <table class="table table-bordered table-hover" width="100%">
                  <thead>
                    <tr style="background-color: #efefef; height: 50px; color: #555555;">
                      <th class="text text-center" width="70%" style="vertical-align: middle;">ชื่อประเภทบทความ </th>
                      <th class="text text-center" width="10%">จำนวนบทความ</th>
                      <th width="10%"></th>
                      <th width="10%"></th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
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
@endsection
