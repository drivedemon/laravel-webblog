@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                  จำนวนรายการทั้งหมด <span id="total"></span> รายการ
                  <a href="{{route('tags.create')}}" class="btn btn-success btn-sm float-md-right "><i class="fa fa-plus"></i> &nbsp;เพิ่มแท็ก</a>
                </div>
                <div class="card-body">
                    <div class="container">
                      @include('ajax.search')
                      <div class="form-group row">
                        <div class="col-md-1">
                        </div>
                        <div class="col-md-10">

                          <table class="table table-bordered table-hover">
                            <thead>
                              <tr style="background-color: #efefef; height: 50px; color: #555555;">
                                <th class="text text-center" style="vertical-align: middle;">ชื่อแท็ก</th>
                                <th class="text text-center" width="15%">จำนวนบทความ</th>
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
                        <div class="col-md-12">
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
