@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                  จำนวนรายการทั้งหมด {{$posts->total()}} รายการ
                  <a href="{{route('posts.create')}}" class="btn btn-success btn-sm float-md-right ">เพิ่มบทความ</a>
                </div>
                <div class="card-body">


                    <div class="container">
                      <div class="row">
                        <div class="col-md-1">
                        </div>
                        <div class="col-md-10">
                          @if($posts->count() > 0)
                          <table class="table table-bordered table-hover">
                            <thead>
                              <tr style="background-color: #efefef; height: 50px; color: #555555;">
                                <th width="15%"></th>
                                <th class="text text-center" style="vertical-align: middle;">ชื่อบทความ</th>
                                <th class="text text-center" width="15%">ประเภทบทความ</th>
                                <th width="10%"></th>
                                <th width="10%"></th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($posts->all() as $post)
                                <tr>
                                  <td align="center"><img src="storage/{{$post->image}}" width="90px" height="70px"></td>
                                  <td>{{$post->title}}<br>
                                    <small class="text-muted">&emsp; - {{$post->description}}</small>
                                  </td>
                                  <td class="text-center">
                                    <a href="{{route('categories.edit', $post->category->id)}}">{{$post->category->name}}</a>
                                  </td>
                                  <td class="text-center">
                                    <a href="{{route('posts.edit', $post->id)}}" class="btn btn-info btn-sm">แก้ไข</a>
                                  </td>
                                  <td class="text-center">
                                    <form class="delete_form" action="{{route('posts.destroy', $post->id)}}" method="post">
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
                                <th>บทความ</th>
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
                          {{$posts->links()}}
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
