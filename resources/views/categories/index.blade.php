@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">
          จำนวนรายการทั้งหมด {{$categories->total()}} รายการ
          <a href="{{route('categories.create')}}" class="btn btn-success btn-sm float-md-right "><i class="fa fa-plus"></i> &nbsp;เพิ่มประเภทบทความ</a>
        </div>
        <div class="card-body">
          <div class="container">
            <div class="row">
              <div class="col-md-1">
              </div>
              <div class="col-md-10">
                @if($categories->count() > 0)
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr style="background-color: #efefef; height: 50px; color: #555555;">
                      <th class="text text-center" style="vertical-align: middle;">ชื่อประเภทบทความ </th>
                      <th class="text text-center" width="15">จำนวนบทความ</th>
                      <th width="10%"></th>
                      <th width="10%"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($categories->all() as $category)
                    <tr>
                      <td>&emsp;{{$category->name}}</td>
                      <td class="text-center">{{$category->post->count()}}</td>
                      <td class="text-center">
                        <a href="{{route('categories.edit', $category->id)}}" class="btn btn-info btn-sm">แก้ไข</a>
                      </td>
                      <td class="text-center">
                        <form class="delete_form" action="{{route('categories.destroy', $category->id)}}" method="post">
                          @csrf
                          <input type="hidden" name="_method" value="DELETE">
                          <input type="submit" name="" value="ลบ" class="btn btn-danger btn-sm">
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
                      <th>ประเภทบทความ</th>
                    </tr>
                  </thead>
                  <tbody>
                    <th class="text-center">
                      ไม่มีบทความ
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
                {{$categories->links()}}
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
