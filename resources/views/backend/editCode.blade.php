@extends('layouts.backend.app')
@section('content')
<div class="card-header">
    <h3>Chỉnh sửa thông tin code</h3>
</div>

<form action="{{route('manage-code.update', $code->id)}}" method="POST">
    @method('PATCH')
    @csrf
    <div class="card-body">
        <label><strong>Mã giảm giá</strong></label>
        <input type="text" name="code" class="form-control" value="{{$code->code}}" readonly>
        <br>

        <label><strong>Chức năng</strong></label>
        <br>
        @if ($code->role == 0)
        Giảm theo % <input type="radio" name="role" id="" value="0" checked="checked"> &nbsp; &nbsp;
        Giảm theo tiền mặt (nghìn đồng)<input type="radio" name="role" id="" value="1">
        <br>
        @else
        Giảm theo % <input type="radio" name="role" id="" value="0" > &nbsp; &nbsp;
        Giảm theo tiền mặt (nghìn đồng) <input type="radio" name="role" id="" value="1" checked="checked">
        @endif
        <br>
        <br>
        <label><strong>Đơn vị giảm</strong></label>
        <input type="text" name="amount" class="form-control" value="{{$code->amount}}">
        <br>
        <br>
        <label><strong>Áp dụng cho đơn hàng từ: (.000 VNĐ)</strong></label>
        <input type="text" name="limited" class="form-control" value="{{$code->limited}}">
        <br>
        <label><strong>Số lượt dùng</strong></label>
        <input type="text" name="use_time" class="form-control" value="{{$code->use_time}}" >
        <br>
    </div>
    <div class="card-footer">
        <a href="" class="btn btn-danger">Hủy</a>
        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
    </div>
</form>
@endsection