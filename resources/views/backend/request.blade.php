@extends('layouts.backend.app')
@section('content')
<div class="card">
    <div class="card-header">
        <h3>Báo giá sản phẩm: <a href="{{$quotation->link_product}}" target="_blank" rel="noopener noreferrer">{{$quotation->link_product}}</a></h3> 
    </div>
    <form action="{{route('manage-quotation.update',$quotation->id)}}" method="POST" enctype="multipart/form-data">
        @method('PATCH')           
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label><b>Tên sản phẩm: {{$quotation->product_name}}</label>
            </div>
            <div class="form-group">
                <label><b>Thông tin sản phẩm khách yêu cầu: {{$quotation->product_info}}</label>
            </div>
            <div class="form-group">
                <label><b>File thông tin: </label>
                <a href="{{asset('file/'.$quotation->filename)}}" download>{{$quotation->filename }}</a>
            </div>
            <div class="form-group">
                <label><b>Thông tin khách hàng:</label>
                <p>Tên: {{$quotation->username}}</p>
                <p>Số điện thoại: {{$quotation->phone}}</p>
                <p>Email: {{$quotation->email}}</p>
            </div>
            <label><b>Nội Dung thư báo giá: </label>
            <textarea name="content" id="editor1" class="@error('content') is-invalid @enderror">{{ old('content') }}</textarea>
        </div>
        
        <div class="card-footer">
            <div class="row">
                <div class="col-6 text-right">
                    <a href="{{route('manage-quotation.index')}}" class="btn btn-danger">Hủy</a>
                </div>
                <div class="col-6 text-left">
                    <button type="submit" class="btn btn-primary">Gửi báo cáo</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection