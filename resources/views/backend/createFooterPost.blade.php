@extends('layouts.backend.app')
@section('content')
<div class="card">
    <div class="card-header">
        <h3>Thêm mới bài viết giới thiệu</h3>
    </div>
    <form action="{{route('manage-footer-post.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card-body login">
            <div class="login-form">
                <div class="form-group">
                    <label>Danh mục: </label>
                    <select name="category" class="form-control">
                        <option value="0" selected>Hỗ trợ</option>
                        <option value="1">Liên hệ</option>
                        <option value="2">Hotline</option>
                        <option value="3">Email</option>
                        <option value="4">Câu hỏi thường gặp</option>
                        <option value="5">Thông báo</option>
                        <option value="6">Chi tiết sản phẩm</option>
                        <option value="7">Thông tin trang web</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Ảnh: </label><br>
                    <input type="file" name="filename">
                </div>
                <div class="form-group">
                    <label class="placeholder"><b>Tên bài viết</b></label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autofocus>
                    @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Nội Dung: </label>
                    <textarea name="content" class="form-control " id="editor1" required>{{old('content')}}</textarea>
                </div>
                <div class="form-group">
                    <label><strong>Trạng thái</strong></label>
                    <br>
                    <input type="radio" name="status" id="" value="1" checked="checked"> Hoạt động &nbsp;
                    <input type="radio" name="status" id="" value="0"> Vô hiệu hóa
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="form-group">
                <a href="{{route('manage-footer-post.index')}}" class="btn btn-danger">Hủy</a>
                <button type="submit" class="btn btn-primary">Thêm bài viết</button>
            </div>
        </div>
    </form>
</div>
@endsection