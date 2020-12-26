@extends('layouts.backend.app')
@section('content')
<div class="card">
    <div class="card-header">
        <h3>Sửa thông tin bài viết: {{$post->title}}</h3> 
    </div>
    
    <div class="card-body">
        <form action="{{route('manage-post.update',$post->id)}}" method="POST" enctype="multipart/form-data">
            @method('PATCH')           
            @csrf
            <label>Danh mục bài viết: </label>
            <select class="form-control @error('category') is-invalid @enderror" name="category" value="{{ old('category') }}">
                <option selected value="{{$post->category}}">{{$post->postCategory->title}}</option>
                @foreach ($categories as $item)
                <option value="{{$item->id}}">{{$item->title}}</option>
                @if(count($item->childs))
                @include('backend.selectChildProduct',['childs' => $item->childs])
                @endif
                @endforeach
            </select>
            @error('category')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <label>Tiêu đề: </label>
            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" value="{{ $post->title }}" required>
            @error('title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <br>
            <label>Ảnh bài viết cũ</label><br>
            <div class="col-6">
                <img src="{{asset('images/'.$post->filename)}}" alt="" width="50%">
            </div>
            <br>
            <div class="form-group">
                <label>Chọn ảnh bài viết</label>
                <input type="file" name="filename" accept="image/*">
            </div>
            <label>Mô Tả</label>
            <textarea name="description" id="" cols="30" rows="10" placeholder="Phần mô tả ngắn sẽ hiện lên trang chủ cùng tiêu đề" class="form-control @error('description') is-invalid @enderror" required >{{ old('description') }}{{$post->description}}</textarea>
            <br>
            <label>Nội Dung</label>
            <textarea name="content" id="editor1" class="@error('content') is-invalid @enderror">{{ old('content') }}{{$post->content}}</textarea>
            <br>
            <label>Gắn tag</label><br>
            <div class="form-control">
                @foreach ($allTag as $tags)
                @if (App\Models\ProductPostTag::where([['tags_id',$tags->id],['posts_id',$post->id]])->first())
                <input type="checkbox" name="tag[]" value="{{$tags->id}}" checked> {{$tags->name}} &nbsp;
                @else 
                <input type="checkbox" name="tag[]" value="{{$tags->id}}"> {{$tags->name}} &nbsp;
                @endif
                @endforeach
            </div>
        </div>
        
        <div class="card-footer">
            <div class="row">
                <div class="col-6 text-right">
                    <a href="{{route('manage-product.index')}}" class="btn btn-danger">Hủy</a>
                </div>
                <div class="col-6 text-left">
                    <button type="submit" class="btn btn-primary">Sửa bài viết</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
    function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]);
  }
}

$("#imgInp").change(function() {
  readURL(this);
});
</script>
@endsection