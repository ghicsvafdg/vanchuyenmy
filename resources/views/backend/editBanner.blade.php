@extends('layouts.backend.app')
@section('content')
<div class="card">
    <h1>Vị trí hiển thị banner</h1>
    <div class="row">
        <div class="col-8">
            <h2>Trang chủ</h2>
            <img src="{{asset('images/index_section.png')}}" alt="" height="400" width="500" >
        </div>
        <div class="col-4">
            <h2>Trang chi tiết sản phẩm</h2>
            <img src="{{asset('images/detail_section.png')}}" alt="" height="600" width="300">
        </div>
        <div class="col-8">
            <h2>Trang danh mục sản phẩm</h2>
            <img src="{{asset('images/cate_section.png')}}" alt="" height="400" width="500">
        </div>
        <div class="col-4">
            <h2>Quy tắc</h2>
            <table class="text-center table table-bordered table-striped">
                <tr>
                    <td>Khu vực</td>
                    <td>Số lượng banner tối đa</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>5</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>4</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>1</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>1</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>2</td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>5</td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h3>Sửa thông tin banner khu vực {{$banner->section}}</h3>
    </div>
    
    <form action="{{route('manage-banner.update',$banner->id)}}" method="POST" enctype="multipart/form-data" class="form-group">
        @method('PATCH')           
        @csrf
        <div class="card-body">
        
            <label>Chọn khu vực: </label>
            <select class="form-control @error('section') is-invalid @enderror" name="section" value="" disabled>
                <option selected value="{{$banner->section}}">{{$banner->section}}</option>
            </select>
            @error('section')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <label>Tên banner: </label>
            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ $banner->name }}" required>
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <label>Upload Banner</label><br>
            <strong>định dạng: jpeg,png,jpg,gif,svg | tối đa: 2MB mỗi ảnh</strong>
            <input type="file" class="form-control" name="filename[]" id="file" accept="image/*" multiple />
        </div>    
        <div class="card-footer">
            <div class="row">
                <div class="col-6 text-right">
                    <a href="{{route('manage-banner.index')}}" class="btn btn-danger">Hủy</a>
                </div>
                <div class="col-6 text-left">
                    <button type="submit" class="btn btn-secondary">Sửa</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection