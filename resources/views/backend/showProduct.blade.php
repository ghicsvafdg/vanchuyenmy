@extends('layouts.backend.app')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-6">
                <h3>Thông tin sản phẩm vừa thêm</h3>
            </div>
            <div class="col-6 text-right">
                <a href="{{route('manage-product.create')}}" class="btn btn-primary">Thêm sản phẩm khác</a>
            </div>
        </div>
    </div>
    
    <div class="card-body">
            <label>Danh mục sản phẩm: </label>
            <select class="form-control" name="category" disabled>
                <option selected value="">{{$product->productCategory->title}}</option>
            </select>
            <br>
            <label>Tên sản phẩm: </label>
            <input class="form-control" type="text" name="title" value="{{$product->name}}" required disabled>
            <br>
            <label>Link video sản phẩm:</label>
            <input type="text" class="form-control" value="{{$product->video}}" disabled>
            <br>
            <label>Ảnh sản phẩm</label>
            <br>
            @foreach ($image as $img)
                <img src="{{asset('images/'.$img)}}" alt="" height="100" width="100">
            @endforeach
            <br>
            <label>Số lượng: </label>
            <input type="text" name="quantity" class="form-control" disabled value="{{$product->quantity}}">
            <br>
            <label>Các màu của sản phẩm (nếu có)</label><br>
            <input type="text" name="color" class="form-control" disabled value="{{$product->color}}">
            <br>
            <label>Các size của sản phẩm (nếu có)</label><br>
            <input type="text" name="size" class="form-control" disabled value="{{$product->size}}">
            <br>
            <label>Giá gốc 1 sản phẩm (nghìn VNĐ)</label>
            <input type="text" name="price" class="form-control" disabled value="{{number_format( $product->price, 0, ',', ' ' )}} 000">
            <br>
            <label>Giá khuyến mại 1 sản phẩm (nếu có) (nghìn VNĐ)</label>
            <input type="text" name="promition" class="form-control" disabled 
            value="@isset($pr->promotion)
            {{number_format( $pr->promotion, 0, ',', ' ' )}} 000
            @endisset">
            <br>
            <label>Mô Tả</label>
            <textarea name="description" id="editor2" cols="30" rows="10" 
            placeholder="Điền các thông số như là:
                            Thương hiệu: 
                            Xuất xứ: 
                            ..."
            class="form-control" disabled>{{$product->description}}</textarea>
            <br>
            <label>Chi tiết sản phẩm: </label>
            <textarea name="content" class="form-control" id="editor1" disabled>{{$product->content}}</textarea>
            <br>
            <div class="form-control">
                @foreach ($allTag as $tags)
                @if (App\Models\ProductPostTag::where([['tags_id',$tags->id],['products_id',$product->id]])->first())
                <input type="checkbox" disabled checked> {{$tags->name}} &nbsp;
                @else 
                <input type="checkbox" disabled> {{$tags->name}} &nbsp;
                @endif
                @endforeach
            </div>
        </div>
        
        <div class="card-footer">
            <div class="row">
                <div class="col-6 text-right">
                    <a href="{{route('manage-product.index')}}" class="btn btn-danger">Quay về</a>
                </div>
                <div class="col-6 text-left">
                    <a href="{{route('manage-product.edit', $product->id)}}" class="btn btn-secondary" data-toggle="tooltip" data-placement="bottom" title="Edit">
                        Sửa thông tin sản phẩm
                    </a>
                </div>
            </div>
        </div>
</div>
@endsection