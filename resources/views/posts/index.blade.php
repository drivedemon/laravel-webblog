@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
          @if(Session()->has('success'))
            <div class="alert alert-success">
              {{Session()->get('success')}}
            </div>
          @endif
            <div class="card">
                <div class="card-header">
                  บทความ
                  <a href="{{route('posts.create')}}" class="btn btn-success btn-sm float-md-right ">เพิ่มบทความ</a>
                </div>
                <div class="card-body">

                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <script type="text/javascript">
  $(document).ready(function() {
    $('.delete_form').on('submit', function() {
      if (confirm('ต้องการลบข้อมูลใช่ไหม')) {
        return true;
      } else {
        return false;
      }
    })
  })
</script> -->
@endsection
