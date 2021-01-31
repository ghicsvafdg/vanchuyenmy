@extends('layouts.backend.app')
@section('content')
<div class="card">
    <div class="card-header">
        <h3>Sửa thông tin sản phẩm <b>{{$product->name}}</b></h3> 
    </div>
    <div class="card-body">
        <form action="{{route('manage-product.update',$product->id)}}" id="mainform" method="POST" enctype="multipart/form-data">
            @method('PATCH')           
            @csrf
            <label>Danh mục sản phẩm: </label>
            <select class="form-control @error('category') is-invalid @enderror" name="category" value="{{ old('category') }}">
                <option selected value="{{$product->category_id}}">{{$product->productCategory->title}}</option>
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
            <label>Tên sản phẩm: </label>
            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ $product->name }}" required>
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <br>
            <label>Link video sản phẩm:</label>
            <input type="text" name="video" class="form-control" value="{{ $product->video }}">
            <br>
            <label>Ảnh cũ sản phẩm</label>
            @foreach ($image as $img)
                <img src="{{asset('images/'.$img)}}" alt="" height="100" width="100">
            @endforeach
            <br>
            <label>Ảnh sản phẩm</label><br>
            <strong>định dạng: jpeg, png, jpg, gif, svg | tối đa: 2MB mỗi ảnh</strong>
            <br><strong>Nếu không thêm, ảnh cũ sản phẩm sẽ được giữ nguyên</strong>
            <button type="button" onclick="add_field()" class="btn btn-primary">ADD IMAGES</button>
            <div class="row getImage"></div>
            <br>
            <div>
                <label>Mô Tả</label>
                <textarea name="description" id="editor2" cols="30" rows="10" placeholder="Phần mô tả ngắn sẽ hiện lên trang chủ cùng tiêu đề"
                          class="form-control @error('description') is-invalid @enderror" required >{{ old('description') }} {{$product->description}}</textarea>
            </div>
            <br>
            <label>Chi tiết sản phẩm: </label>
            <textarea name="content" class="form-control @error('content') is-invalid @enderror" id="editor1" required>{{ old('content') }} {{$product->content}}</textarea>
            <br>
            <label>Số lượng: </label>
            <input type="text" name="quantity" class="form-control" value="{{$product->quantity}}">
            <br>
            <label>Các màu của sản phẩm (nếu có)</label><br>
            <strong>ghi tên màu sản phẩm dưới dạng: đỏ, xanh, vàng, tím,...</strong>
            <input type="text" name="color" class="form-control" value="{{$product->color}}">
            <br>
            <label>Các size của sản phẩm (nếu có)</label><br>
            <strong>ghi tên size sản phẩm dưới dạng: S, X, XL,... hoặc 35, 38, 40...</strong>
            <input type="text" name="size" class="form-control" value="{{$product->size}}">
            <br>
            <label>Giá gốc 1 sản phẩm (nghìn VNĐ)</label>
            <input type="text" name="price" class="form-control" value="{{number_format( $product->price, 0, ',', '' )}}">
            <br>
            <label>Giá khuyến mại 1 sản phẩm (nếu có) (nghìn VNĐ)</label>
            <input type="text" name="promotion" class="form-control" value="{{number_format( $product->promotion, 0, ',', '' )}}">
            <br>
            <label>Trạng thái</label><br>
            @if ($product->status == 1)
            <input type="radio" name="status" id="" value="1" checked> Hoạt động
            <input type="radio" name="status" id="" value="0"> Tạm ẩn
            @else 
            <input type="radio" name="status" id="" value="1"> Hoạt động
            <input type="radio" name="status" id="" value="0" checked> Tạm ẩn
            @endif
            <br>
            <label>Gắn tag</label><br>
            <div class="form-control">
                @foreach ($allTag as $tags)
                @if (App\Models\ProductPostTag::where([['tags_id',$tags->id],['products_id',$product->id]])->first())
                <input type="checkbox" name="tag[]" value="{{$tags->id}}" checked> {{$tags->name}} &nbsp;
                @else 
                <input type="checkbox" name="tag[]" value="{{$tags->id}}"> {{$tags->name}} &nbsp;
                @endif
                @endforeach
            </div>
        
            <div class="card-footer">
                <div class="row">
                    <div class="col-6 text-right">
                        <a href="{{route('manage-product.index')}}" class="btn btn-danger">Hủy</a>
                    </div>
                    <div class="col-6 text-left">
                        <button type="submit" class="btn btn-primary">Sửa sản phẩm</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('script')
    <script>
        function add_field() {
            var x = $("#mainform");
            var row_div = $("#mainform .getImage ");
            var count = $("#mainform .getImage div").length; // get divs count

            // create an input field to insert
            var new_field = "<input type='file' name='filename[]' accept='image/*' class='form-control col' id='img"+count+"'/>"

            // preview
            var preview = "<img src='#' id='preview-img"+count+"' height='250px' width='250px'>";

            // insert element
            row_div.append('<div class="col-3">'+ preview + new_field +'</div>');

            $("form#mainform input[type='file']").change(function(){
                readURL(this);
            });
        }

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    imgId = '#preview-'+$(input).attr('id');
                    $(imgId).attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection