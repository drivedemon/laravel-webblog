@if(Auth::check() && auth()->user()->role_pending != 'noapprove')
<hr style="border: 0.5px solid;">
<form action="{{route('comment.store')}}" method="post" enctype="multipart/form-data">
  @csrf
  <input type="hidden" name="pid" value="{{$post->id}}">
  <h5><i class="fa fa-commenting-o" aria-hidden="true"></i> แสดงความคิดเห็น</h5>
  <div class="card">
    <div class="card-header">
    </div>
    <div class="card-body">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            @if(Session()->has('success'))
              <div class="alert alert-success">
                {{Session()->get('success')}}
              </div>
              <br>
            @endif
            @if($errors->any())
              <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                  {{$error}}
                @endforeach
              </div>
              <br>
            @endif
          </div>
          <div class="col-md-12">
            <textarea name="comment" rows="8" cols="80"></textarea>
          </div>
          <div class="col-md-3">
            <input type="submit" name="" value="ส่งข้อความ" class="btn btn-success">
          </div>
          <div class="col-md-9">
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
@endif
