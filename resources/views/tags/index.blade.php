@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                  จำนวนรายการทั้งหมด {{$tags->total()}} รายการ
                  <a href="{{route('tags.create')}}" class="btn btn-success btn-sm float-md-right ">เพิ่มแท็ก</a>
                </div>
                <div class="card-body">


                    <div class="container">
                      <div class="row">
                        <div class="col-md-1">
                        </div>
                        <div class="col-md-10">
                          @if($tags->count() > 0)
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
                              @foreach($tags->all() as $tag)
                                <tr>
                                  <td>&emsp;{{$tag->name}}</td>
                                  <td class="text-center">{{$tag->post->count()}}</td>
                                  <td class="text-center">
                                    <a href="{{route('tags.edit', $tag->id)}}" class="btn btn-info btn-sm">แก้ไข</a>
                                  </td>
                                  <td class="text-center">
                                    <form class="delete_form" action="{{route('tags.destroy', $tag->id)}}" method="post">
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
                                <th>แท็ก</th>
                              </tr>
                            </thead>
                            <tbody>
                              <th class="text-center">
                                ไม่มีแท็ก
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
                          {{$tags->links()}}
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
