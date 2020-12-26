@extends('layouts.backend.app')
@section('content')
<div class="card-header">
    <h3>Chỉnh sửa thông tin danh mục {{$category->title}}</h3>
</div>
<form action="{{route('manage-post-category.update', $category->id)}}" method="POST">
    @method('PATCH')
    @csrf
    <div class="card-body">
        <label>Tên:</label>
        <input type="text" name="title" class="form-control" value="{{$category->title}}">
        <br>
        <label>Số thứ tự:</label>
        <input type="text" name="order" class="form-control" value="{{$category->order}}">
        <br>
        <label>Thuộc về danh mục: </label>
        <select class="form-control" name="id">
            @if ($category->parent_id !=0)
            <option selected value="{{$cate->id}}">{{$cate->title}}</option>
            @else
            <option selected value=""></option>
            @endif
            @foreach ($categories as $item)
            <option value="{{$item->id}}">{{$item->title}}</option>
            @if(count($item->childs))
            @include('backend.selectChildProduct',['childs' => $item->childs])
            @endif
            @endforeach
        </select>
        <span class="text-danger">{{ $errors->first('parent_id') }}</span>
        
    </div>
    
    <div class="card-footer">
        <a href="{{route('manage-post-category.index')}}" class="btn btn-danger">Hủy</a>
        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
    </div>
</form>
@endsection