@extends('layouts.backend.app')
@section('content')
<div class="card">
    <div class="card-header">
        <h3>Thêm mới bài viết</h3>
    </div>
    
    <div class="card-body">
        <form action="{{route('manage-post.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <label>Danh mục bài viết: </label>
            <select class="form-control @error('category') is-invalid @enderror" name="category" value="{{ old('category') }}">
                <option selected value="0"></option>
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
            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" value="{{ old('title') }}" required>
            @error('title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <br>
            <label>Ảnh đại diện bài viết</label>
            <input type="file" name="filename" accept="image/*" required>
            <br>
            <label>Mô Tả</label>
            <textarea name="description" id="" cols="30" rows="10" placeholder="Phần mô tả ngắn sẽ hiện lên trang chủ cùng tiêu đề" class="form-control @error('description') is-invalid @enderror" required>{{ old('description') }}</textarea>
            <br>
            <label> Nội Dung</label>
            <textarea name="content" class="form-control " id="editor1"></textarea>
            <br>
            <div class="row">
                <div class="col-3">
                    <label><b>Gắn tag</b></label>
                    <br>
                </div>
                <div class="col-12">
                    @foreach ($tag as $item)
                    <input type="checkbox" name="tag[]" value="{{$item->id}}"> {{$item->name}}<br>
                    @endforeach
                </div>
            </div>
        </div>
        
        <div class="card-footer">
            <div class="row">
                <div class="col-6 text-right">
                    <a href="{{route('manage-post.index')}}" class="btn btn-danger">Hủy</a>
                </div>
                <div class="col-6 text-left">
                    <button type="submit" class="btn btn-primary">Thêm</button>
                </div>
            </div>
        </div>

    </form>
</div>
@endsection
@section('script')
{{-- <script>
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
</script> --}}
@endsection