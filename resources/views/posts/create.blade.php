@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      @if($errors->any())
      <div class="alert alert-danger">
        <ul class="list-group">
          @foreach($errors->all() as $error)
          <li class="list-group-item">{{$error}}</li>
          @endforeach
        </ul>
      </div>
      @endif
      <div class="card">
        <div class="card-header">
          {{isset($post)?'แก้ไขบทความ':'เพิ่มบทความ'}}
        </div>
        <div class="card-body">
          <form action="{{isset($post)?route('posts.update', $post->id):route('posts.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            @if(isset($post))
            @method('put')
            @endif
            <div class="form-group row">
              <label for="" class="col-md-1 col-form-label"></label>
              <label for="" class="col-md-2 col-form-label">ประเภทบทความ <span style="color:red;">*</span></label>
              <div class="col-md-5">
                <select class="form-control" name="category">
                  @foreach($categories as $category)
                    <option value="{{$category->id}}"
                      @if(isset($post))
                        @if($category->id == $post->category_id)
                          selected
                        @endif
                      @endif
                      >{{$category->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group row">
            @if ($tags->count() > 0)
              <label for="" class="col-md-1 col-form-label"></label>
              <label for="" class="col-md-2 col-form-label">แท็ก <span style="color:red;">*</span></label>
              <div class="col-md-7">
                  <select class="form-control" name="tags[]" id="select2" multiple>
                    @foreach($tags as $tag)
                      <option value="{{$tag->id}}"
                        @if(isset($post))
                          @if($post->hasTag($tag->id))
                            selected
                          @endif
                        @endif
                        >{{$tag->name}}</option>
                    @endforeach
                  </select>
              </div>
            @else
              <label for="" class="col-md-3 col-form-label"></label>
              <small class="col-md-9" style="color:gray;">ตอนนี้ไม่มีแท็กบทความ หากต้องการเพิ่ม <a href="{{route('tags.create')}}">คลิ๊ก</a></small>
            @endif
            </div>
            <div class="form-group row">
              <label for="" class="col-md-1 col-form-label"></label>
              <label for="" class="col-md-2 col-form-label">ชื่อบทความ <span style="color:red;">*</span></label>
              <div class="col-md-7">
                <input type="text" class="form-control" name="title" id="" value="{{isset($post)?$post->title:''}}">
              </div>
            </div>
            <div class="form-group row">
              <label for="" class="col-md-1 col-form-label"></label>
              <label for="" class="col-md-2 col-form-label">คำอธิบาย <span style="color:red;">*</span></label>
              <div class="col-md-7">
                <input type="text" class="form-control" name="description" id="" value="{{isset($post)?$post->description:''}}">
              </div>
            </div>
            <div class="form-group row">
              <label for="" class="col-md-1 col-form-label"></label>
              <label for="" class="col-md-2 col-form-label">เนื้อหา <span style="color:red;">*</span></label>
              <div class="col-md-7">
                <input id="x" type="hidden" name="content" value="{{isset($post)?$post->content:''}}">
                <trix-editor input="x"></trix-editor>
              </div>
            </div>
            <div class="form-group row">
              <label for="" class="col-md-1 col-form-label"></label>
              <label for="" class="col-md-2 col-form-label">
                รูปภาพประกอบ
                @if(empty($post))
                  <span style="color:red;">*</span>
                @endif
              </label>
              <div class="col-md-5">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="image" id="file-upload" aria-describedby="inputGroupFileAddon01" accept=".jpg,.png">
                  <label class="custom-file-label" for="file-upload" id="file-upload-filename">Choose file</label>
                  <small class="form-text text-muted">รองรับ ไฟล์ .pdf / .jpg เท่านั้น ขนาดไม่เกิน 10 MB / ไฟล์.</small>
                </div>
              </div>
            </div>
            <div class="form-group text-center">
              <input type="submit" name="" value="{{isset($post)?'อัปเดตบทความ':'เพิ่มบทความ'}}" class="btn btn-success">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
<script type="text/javascript">
$(document).ready(function() {
    $('#select2').select2();
});

var input = document.getElementById( 'file-upload' );
var infoArea = document.getElementById( 'file-upload-filename' );
input.addEventListener( 'change', showFileName );
function showFileName( event ) {
  var input = event.srcElement;
  var fileName = input.files[0].name;
  infoArea.textContent = fileName;
}
</script>
@endsection
