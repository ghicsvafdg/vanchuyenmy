@extends('layouts.backend.app')
@section('content')
<div class="card">
    <div class="card-header">
        <h3>Thêm mới sản phẩm</h3>
    </div>
    
    <div class="card-body">
        <form action="{{route('manage-product.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <label>Danh mục sản phẩm: </label>
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
            <br>
            <label>Tên sản phẩm: </label>
            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('title') }}" required>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <br>
            <label>Link video sản phẩm:</label>
            <input type="text" name="video" class="form-control">
            <br>
            <label>Ảnh sản phẩm</label><br>
            <strong>định dạng: jpeg,png,jpg,gif,svg | tối đa: 2MB mỗi ảnh</strong>
            <input type="file" class="form-control" name="filename[]" id="file" accept="image/*" multiple />
            <br>
            <label>Số lượng: </label>
            <input type="text" name="quantity" class="form-control">
            <br>
            <label>Các màu của sản phẩm (nếu có)</label><br>
            <strong>ghi tên màu sản phẩm dưới dạng: đỏ, xanh, vàng, tím,...</strong>
            <input type="text" name="color" class="form-control">
            <br>
            <label>Các size của sản phẩm (nếu có)</label><br>
            <strong>ghi tên size sản phẩm dưới dạng: S, X, XL,... hoặc 35, 38, 40...</strong>
            <input type="text" name="size" class="form-control">
            <br>
            <label>Giá gốc 1 sản phẩm (nghìn VNĐ):</label>
            <input type="text" name="price" class="form-control">
            <br>
            <label>Giá khuyến mại 1 sản phẩm (nếu có) (nghìn VNĐ):</label>
            <input type="text" name="promotion" class="form-control">
            <br>
            <label>Mô Tả:</label>
            <textarea name="description" id="editor1" cols="30" rows="10" 
            placeholder="Điền các thông số như là:
                            Thương hiệu: 
                            Xuất xứ: 
                            ..."
            class="form-control @error('description') is-invalid @enderror" required>{{ old('description') }}</textarea>
            <br>
            <label>Chi tiết sản phẩm: </label>
            <textarea name="content" class="form-control" id="editor2"></textarea>
            <br>
            
            
            <div class="row">
                <div class="col-12 row">
                    <div class="col-3">
                        <label><b>Trạng thái</b></label>
                        <hr>
                    </div>
                </div>
                <div class="col row">
                    <div class="col">
                        <input type="radio" name="status" id="" value="1" checked> Hoạt động
                    </div>
                    <div class="col">
                        <input type="radio" name="status" id="" value="0"> Tạm ẩn
                    </div>
                </div>
                <div class="col"></div>
            </div>
            
            <br>
            <div class="row">
                <div class="col-3">
                    <label><b>Gắn tag</b></label>
                    <hr>
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
                    <a href="{{route('manage-product.index')}}" class="btn btn-danger">Hủy</a>
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



@endsection