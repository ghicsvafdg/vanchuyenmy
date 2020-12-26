@extends('layouts.backend.app')
@section('content')
<div class="card-header">
    <h3>Chỉnh sửa đơn hàng {{$order->order_code}}</h3>
</div>

<form action="{{route('manage-order.update', $order->id)}}" method="POST">
    @method('PATCH')
    @csrf
    <div class="card-body">
        <label><strong>Mã đơn hàng</strong></label>
        <input type="text" class="form-control" value="{{$order->order_code}}" readonly>
        <br>
        <label><strong>Địa chỉ nhận hàng</strong></label>
        <input type="text" class="form-control" value="{{$order->address}}" readonly>
        <br>
        <label><strong>Người nhận</strong></label>
        <input type="text" class="form-control" value="{{$order->name}}" readonly>
        <br>
        <label><strong>Số điện thoại người nhận</strong></label>
        <input type="text" class="form-control" value="{{$order->phone}}" readonly>
        <br>
        <label><strong>Phương thức thanh toán</strong></label>
        <input type="text" class="form-control" 
        value="@if ($order->form == 1)
        Chuyển toàn bộ tiền hàng trước
        @elseif($order->form == 2)
        Chuyển trước 50% số tiền
        @elseif($order->form == 3)
        Thanh toán tại chi nhánh
        @elseif($order->form == 4)
        Thanh toán khi hàng được giao (COD)
        @endif" readonly>
        <br>
        <label><strong>Trạng thái đơn hàng</strong></label>
        <br>
        <select name="status" class="form-control">
            <option value="{{$order->status}}" selected>
                @if ($order->status == 1)
                    Chờ duyệt
                @elseif($order->status == 2)
                    Đã duyệt
                @elseif($order->status == 3)
                    Đang giao hàng
                @elseif($order->status == 4)
                    Đã thanh toán/nhận hàng
                @elseif($order->status == 5)
                    Đã hủy
                @endif
            </option>
            <option value="2">Đã duyệt</option>
            <option value="3">Đang giao hàng</option>
            <option value="4">Đã thanh toán/nhận hàng</option>
            <option value="5">Đã hủy</option>
        </select>
    </div>
    <div class="card-footer">
        <a href="{{route('manage-order.index')}}" class="btn btn-danger">Hủy</a>
        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
    </div>
</form>
@endsection