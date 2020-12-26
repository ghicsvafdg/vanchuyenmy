@extends('layouts.backend.app')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-6">
                <h3>Thông tin đơn hàng {{$order->order_code}}</h3>
            </div>
        </div>
    </div>
    
    <div class="card-body">
        <label>Mã đơn hàng </label>
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
        <label><strong>Các loại hàng order</strong></label>
        <table class="table table-bodered">
            <thead>
                <th>Tên sản phẩm</th>
                <th>Ảnh sản phẩm</th>
                <th>Thuộc tính</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
            </thead>
            <tbody>
                @foreach ($order->orderDetail as $item)
                <tr>
                    <td width="25%">
                        <a href="{{route('san-pham.show',$item->productOrder->slug)}}">{{$item->productOrder->name}}</a>
                    </td>
                    <td>
                        <img src="{{asset('images/'.json_decode($item->productOrder->filename)[0])}}"  class="img-fluid" alt="..." width="60px" height="60px;">
                    </td>
                    <td>
                        Màu sắc: {{$item->color}} <br>
                        Kích cỡ: {{$item->size}}
                    </td>
                    <td>{{$item->quantity}}</td>
                    <td>
                        @if ($item->productOrder->promotion)
                        {{number_format($item->productOrder->promotion*$item->quantity, 0, ',', ' ' ).'.000đ'}}
                        @else
                        {{number_format($item->productOrder->price*$item->quantity, 0, ',', ' ' ).'.000đ'}}
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <br>
        <label><strong>Phương thức thanh toán</strong></label>
        <input type="text" class="form-control" value="{{$order->form}}" readonly>
        <br>
        <label><strong>Mã giảm giá áp dụng</strong></label>
        <input type="text" class="form-control" value="{{$order->voucher}}" readonly>
        <br>
        <label><strong>Trạng thái đơn hàng</strong></label>
        <br>
        <select name="status" class="form-control" disabled>
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
        </select>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-6 text-right">
                <a href="{{route('manage-order.index')}}" class="btn btn-danger">Quay về</a>
            </div>
            <div class="col-6 text-left">
                <a href="{{route('manage-order.edit', $order->id)}}" class="btn btn-secondary" data-toggle="tooltip" data-placement="bottom" title="Edit">
                    Sửa thông tin đơn hàng
                </a>
            </div>
        </div>
    </div>
</div>
@endsection