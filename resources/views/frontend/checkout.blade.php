@extends('layouts.frontend.app')
@section('content')
<div class="container">
    <div class="card mt-5 pt-3"> 
        <div class="row">
            <div class="col-lg-2">
                
            </div>
            <div class="col-lg-9">
                <h3 class="text-center" id="suceed-text"><b>QUÝ KHÁCH ĐÃ TẠO ĐƠN HÀNG THÀNH CÔNG</b></h3>
                <p>Cảm ơn quý khách đã sử dụng dịch vụ VanchuyenMy. VanChuyenMy.vn đã gửi thông tin chi tiết đơn hàng của quý khách vào email <a href="#">ducdu22@gmail.com</a>. Nếu quý khách không tìm thấy vui lòng kiểm tra trong mục Spam hoặc tab Promotion (nếu dùng Gmail)</p>
                <div class="pl-3">
                    <div class="row">
                        <div class="col-4 px-0"  id="infor-pay-left">
                            <p>Mã đơn hàng</p>
                        </div>
                        <div class="col-8 px-0" id="infor-pay-right">
                            <p><b>{{$order->order_code}}</b> <i><a href="{{route('don-hang.show',$order->id)}}">(Xem chi tiết)</a></i></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 px-0"  id="infor-pay-left">
                            <p>Số tiền cần thanh toán</p>
                        </div>
                        <div class="col px-0" id="infor-pay-right">
                            <p>{{$order->price*1000}}đ</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 px-0"  id="infor-pay-left">
                            <p>Trạng thái đơn hàng</p>
                        </div>
                        <div class="col px-0" id="infor-pay-right">
                            <p>Chờ duyệt</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 px-0"  id="infor-pay-left">
                            <p>Hình thức thanh toán</p>
                        </div>
                        <div class="col px-0" id="infor-pay-right">
                            <p>
                            @if ($order->form == 1)
                            Chuyển toàn bộ tiền hàng trước
                            @elseif($order->form == 2)
                            Chuyển trước 50% số tiền
                            @elseif($order->form == 3)
                            Thanh toán tại chi nhánh
                            @elseif($order->form == 4)
                            Thanh toán khi hàng được giao (COD)
                            @endif
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right px-0 col-4" id="single-text-pay">
                            <p>Hướng dẫn chuyển khoản</p>
                        </div>
                        <div class="text-left px-0 col-8" id="details-bank-pay">
                            <p>Ngân hàng ngoại thương Việt Nam-VietCombank</p>
                            <div class="px-3 ml-1">
                                
                                <div class="row pb-2">
                                    <div class="col-lg-4 col-5 pr-0 pr-lg">
                                        Số tài khoản
                                    </div>
                                    <div class="col-lg-8 col-7">
                                        0846128522123522
                                    </div>
                                </div>
                                <div class="row pb-2">
                                    <div class="col-lg-4 col-5 pr-0 pr-lg">
                                        Tên chủ tài khoản
                                    </div>
                                    <div class="col-lg-8 col-7">
                                        Công ty cổ phần VanChuyenMy.vn
                                    </div>
                                </div>
                                <div class="row pb-2">
                                    <div class="col-lg-4 col-5 pr-0 pr-lg">
                                        Chi nhánh ngân hàng
                                    </div>
                                    <div class="col-lg-8 col-7">
                                        Chi nhánh Thanh Xuân
                                    </div>
                                </div>
                                <div class="row pb-2">
                                    <div class="col-lg-4 col-5 pr-0 pr-lg">
                                        Tỉnh/Thành phố
                                    </div>
                                    <div class="col-lg-8 col-7">
                                        Thành phố Hà Nội
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-5 pr-0 pr-lg">
                                        Nội dung chuyển khoản
                                    </div>
                                    <div class="col-lg-8 col-7">
                                        Chuyển tiền cho đơn hàng: {{$order->order_code}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p id="warning3"><i class="fas fa-exclamation-triangle" style="color: #f09819; margin-right: 3px;"></i>VanChuyenMy sẽ có thông báo khi nhận được tin nhắn của quý khách</p>
                        <p>Một lần nữa xin cảm ơn quý khách đã tin tưởng và sử dụng dịch vụ của chúng tôi</p>
                    </div>
                </div>
                <div class="pb-2">
                    <button type="button" class="btn-gradient16" style="width: 500x; margin-left:60px;">Trung tâm trợ giúp <i class="fas fa-angle-double-right"></i></button> 
                    <a href="{{route('index')}}" class="btn-gradient16" style="width: 500x; margin-left:60px;">Tiếp tục mua hàng <i class="fas fa-angle-double-right"></i></a>  
                </div>
                <hr>
                <div class="pb-3 help-support">
                    <p><b>Câu hỏi thường gặp</b></p>
                    <p><a href="#">Xác nhận đơn hàng như thế nào</a></p>
                    <p><a href="#">Thời gian giao hàng</a></p>
                    <p><a href="#">Chính sách đổi trả</a></p>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection