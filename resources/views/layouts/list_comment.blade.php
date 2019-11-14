@if ($total != 0)
  <hr style="border: 0.5px solid;">
  <h5><i class="fa fa-comments-o" aria-hidden="true"></i>&nbsp; {{$total}} ความคิดเห็น</h5>
  @foreach ($comments as $comment)
    <div class="card">
      <div class="card-header">
        ความคิดเห็นที่ {{$rank++}}
      </div>
      <div class="card-body">
        {{$comment->comment}}
      </div>
       <div class="card-footer text-muted text-right">
         by {{$comment->name}}
         <small>{{DateThai($comment->updated_at)}}</small>
       </div>
    </div>
    <br>
  @endforeach
@endif
