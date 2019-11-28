@if ($total != 0)
  <hr style="border: 0.5px solid;">
  @if(Session()->has('success-comment'))
    <div class="alert alert-success">
      {{Session()->get('success-comment')}}
    </div>
    <br>
  @endif
  @if(Session()->has('error-comment'))
    <div class="alert alert-danger">
      {{Session()->get('error-comment')}}
    </div>
    <br>
@endif
<h5><i class="fa fa-comments-o" aria-hidden="true"></i>&nbsp; {{$total}} ความคิดเห็น</h5>
@foreach ($comments as $comment)
  <div class="card">
    <div class="card-header">
      @auth
        @if(auth()->user()->id == $comment->user_id || auth()->user()->role == 'admin')
        <form class="delete_comment" action="{{route('comment.destroy', $comment->id)}}" method="post">
          @csrf
          ความคิดเห็นที่ {{$rank}}
          <input type="hidden" name="_method" value="DELETE">
          <button type="submit" class="fabutton">
            <i class="fa fa-trash float-right" style="font-size:20px; margin-top: 3px; cursor: pointer;"></i>
          </button>
          <i id="edit-button{{$rank}}" class="fa fa-edit float-right" onclick="edit({{$rank}}, {{$comment->id}});"  style="font-size:20px; margin-top: 5px; cursor: pointer;">&nbsp;</i>
        </form>
        @else
          ความคิดเห็นที่ {{$rank}}
        @endif
      @endauth
      @guest
        ความคิดเห็นที่ {{$rank}}
      @endguest
    </div>
    <div class="card-body">
      <span id="comment{{$rank++}}">{{$comment->comment}}</span>
    </div>
    <div class="card-footer text-muted text-right">
      by {{$comment->name}}
      <small>{{DateThai($comment->updated_at)}}</small>
    </div>
  </div>
  <br>
@endforeach
{{$comments->links()}}
<script type="text/javascript">

$(document).on('submit', '.delete_comment', function() {
  if (confirm('ต้องการลบข้อมูลใช่ไหม')) {
    return true;
  } else {
    return false;
  }
})

function edit(n, ind) {
  var url = '{{ route("comment.update", ":id") }}'
      url = url.replace(':id', ind)
  var text = $('#comment'+n),
      input = $('<form action="'+url+'" method="post"><input type="hidden" name="_token" value="{{ csrf_token() }}"><input name="_method" type="hidden" value="PUT"><textarea name="comment" id="txtcomment'+n+'" rows="8" cols="80" required></textarea><button type="submit" class="btn btn-primary btn-sm">แก้ไขข้อความ</button>&emsp;<button class="btn btn-danger btn-sm" id="controls-update'+n+'">ยกเลิกแก้ไข</button></form>')
    text.hide()
    .after(input)

    $('#controls-update'+n).show()

    input.show().focus()
    $('#edit-button'+n).hide()
    $('#txtcomment'+n).val(text.html())

    $('#controls-update'+n).click(function()
    {
      input.remove()
      $('#controls-update'+n).hide()
      $('#edit-button'+n).show()
      text.html($('#txtcomment'+n).val())
        .show();
      return false
    })
}
</script>
@endif
