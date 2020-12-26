<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta charset="utf-8">
    
    <!-- CSS Files -->
    <style>
        .border_email{
            padding: 0px 280px;
        }
        .email-pay{
            text-align: center;
        }
        #email-btn-pay{
            border: 1px solid transparent;
            cursor: pointer;
            color: white;
        }
        #mark-bar-email{
            text-align: left;
            background: #ffffcc;
        }
        .notification{
            margin: 12px 5px 0px 0px;
        }
        .infor_email{
            display: flex;
            padding: 30px 70px;
        }
        .policy_email {
            display: flex;
            padding: 30px 70px;
            
        }
        .policy_email .col-4{
            padding-right: 80px;
        }
        .dear_email{
            padding: 20px 70px;
        }
        #card-main-email{
            margin: 20px 70px ;
            padding: 20px;
        }
        .main-email-left{
            width: 400px;
        }
        .main-email-right{
            width: 400px;
        }
        .main-email{
            display: flex;
        }
        .infor_email .My_account{
            width: 300px;
        }
        .infor_email .email_icon{
            width: 300px;
            text-align: center;
        }
        .infor_email .email_phone{
            width: 300px;
            text-align: right;
        }
        
        
        @media (max-width : 1300px) {
            .border_email{
                margin-right: 0px !important;
                text-align: right !important;
            }
            .border_email{
                padding: 0px 142px;
            }
            
        }
        table, td, th {  
            border: 1px solid #ddd;
            text-align: left;
        }
        
        table {
            border-collapse: collapse;
            width: 100%;
        }
        
        th, td {
            padding: 15px;
        }
        
        .space-text{
            padding: 10px;
        }
        
        
        .table-hover tr:hover{
            background-color:#f5f5f5;
        }
    </style>
    
</head>
<body>
    <div style="background-color: #3399cc; width: 100%;">
        <div style="padding: 0px 135px;">
            <div style="background-color: white;">
                <div style="border-radius:0px;">
                    <div style=" display: flex; padding: 30px 70px;">
                    </div>
                    <div>
                        <div style="font-size: 20px; color: #3399cc; padding-top: 20px; text-align: center; border-bottom: 2px solid #ff6633; box-shadow: 2px 5px 30px #888888;">
                            <b>XÁC NHẬN ĐƠN HÀNG</b>
                            <br>
                            <b>{{$getOrder->order_code}}</b>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div style="padding: 20px 70px;">
                        Kính chào Quý khách 
                        <b>
                            @if($getOrder->userOrder->name) 
                            {{$getOrder->userOrder->name}} 
                            @else
                            {{$getOrder->userOrder->username}}
                            @endif,
                        </b>
                        <br> 
                        <br>
                        chân thành cảm ơn quý khách đã mua sắm tại 
                        <a href="https://vanchuyenmy.vn/" class="new">VanChuyenMy.vn</a>
                        <br>    
                        <br>                                    
                        Chúng tôi hy vọng Quý khách hài lòng với trải nghiệm mua sắm và các sản phẩm đã chọn.
                        <br>
                        <a href="https://vanchuyenmy.vn/" class="new">VanChuyenMy.vn</a> 
                        vừa nhận được thông tin đặt hàng của quý khách với chi tiết đơn hàng như sau:
                        <br>
                        <br>
                        <table style=" border: 1px solid #ddd; text-align: left; border-collapse: collapse; width: 100%;">
                            <tr style="padding: 15px;">
                                <th style="padding: 15px;">THÔNG TIN ĐƠN HÀNG</th>
                                <th style="padding: 15px;">ĐỊA CHỈ GIAO HÀNG</th>
                            </tr>
                            <tr>
                                <td>
                                    <div style="padding: 10px;">Mã đơn hàng: {{$getOrder->order_code}}</div>    
                                    <div style="padding: 10px;">Ngày / Giờ: {{date("d/m/Y",strtotime($getOrder->created_at))}}</div>
                                </td>
                                <td>
                                    <div style="padding: 10px;">Họ và tên: {{$getOrder->name}}</div> 
                                    <div style="padding: 10px;">Địa chỉ: {{$getOrder->address}}</div> 
                                    <div style="padding: 10px;">Số điện thoại: {{$getOrder->phone}}</div>    
                                    <div style="padding: 10px;">Email: {{$getOrder->userOrder->email}}</div>  
                                </td>
                            </tr>
                        </table>
                        <table style="margin-top: 20px; border: 1px solid #ddd; text-align: left; border-collapse: collapse; width: 100%;">
                            <tr style="padding: 15px;">
                                <th style="padding: 15px;">Sản Phẩm</th>
                                <th style="text-align: center;">Số lượng</th>
                                <th style="text-align: center;">Giá tiền</th>
                                <th style="text-align: center;">Tổng cộng</th>
                            </tr>
                            @foreach ($getOrderDetail as $order)
                            <tr style="border: 1px solid #ddd;">
                                <td style="width:30%">
                                    <a href="https://vanchuyenmy.vn/san-pham/{{$order->productOrder->slug}}">{{$order->productOrder->name}}</a>    
                                </td>
                                <td style="text-align: center;">
                                    {{$order->quantity}}
                                </td>
                                <td style="text-align: center;">
                                    @if ($order->productOrder->promotion)
                                    {{number_format($order->productOrder->promotion*1000, 0, ',', ' ' ).'đ'}}
                                    @else
                                    {{number_format($order->productOrder->price*1000, 0, ',', ' ' ).'đ'}}
                                    @endif
                                </td>
                                <td style="text-align: center;">
                                    @if ($order->productOrder->promotion)
                                    {{number_format($order->productOrder->promotion*$order->quantity*1000, 0, ',', ' ' ).'đ'}}
                                    @else
                                    {{number_format($order->productOrder->price*$order->quantity*1000, 0, ',', ' ' ).'đ'}}
                                    @endif
                                </td>
                            </tr>  
                            @endforeach
                        </table>
                        <div style="margin-top: 20px;  border: 1px solid #ddd; text-align: left;">
                            <table style="width: 100%;">
                                <tr>
                                    <th style="width:50%; padding: 15px;">Giá trị đơn hàng</th>
                                    <th >{{number_format($getOrder->price*1000, 0, ',', ' ' )."VNĐ"}}</th>
                                </tr>
                                <tr style="background-color: #ffffcc;">
                                    <td><b>Hình thức thanh toán	</b></td>
                                    <td>
                                        @if ($getOrder->form == 1)
                                        Chuyển toàn bộ tiền hàng trước
                                        @elseif($getOrder->form == 2)
                                        Chuyển trước 50% số tiền
                                        @elseif($getOrder->form == 3)
                                        Thanh toán tại chi nhánh
                                        @elseif($getOrder->form == 4)
                                        Thanh toán khi hàng được giao (COD)
                                        @endif
                                    </td>
                                </tr>
                                <tr style="background-color: #ffffcc;">
                                    <td><b>Tình trạng thanh toán</b></td>
                                    <td>
                                        @if ($getOrder->status == 1)
                                        Chờ duyệt
                                        @elseif($getOrder->status == 2)
                                        Đã duyệt
                                        @elseif($getOrder->status == 3)
                                        Đang giao hàng
                                        @elseif($getOrder->status == 4)
                                        Đã thanh toán/nhận hàng
                                        @elseif($getOrder->status == 5)
                                        Đã hủy
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div>
                    <div style="padding: 20px 70px;">
                        <p>
                            Mọi thắc mắc và góp ý, Quý khách vui lòng liên hệ với chúng tôi qua:
                        </p>
                            Email hỗ trợ :<a href="#" title="" class="new"> support@weshop.com.vn</a> hoặc
                        <br>
                        <br>
                            Tổng đài Chăm sóc khách hàng: 1900 6755 hoặc Hotline : 0932 277 572
                        <br> 
                        <br>                         
                            Weshop trân trọng cảm ơn và rất hân hạnh được phục vụ Quý khách.
                        <br>
                        <br>
                        <br>
                        <b><i>*Quý khách vui lòng không trả lời email này*</i></b>
                        <br>
                        <br>
                        <br>
                    </div>
                    <div style="padding: 30px 70px;">
                        <a href="https://vanchuyenmy.vn/check-cart" title="" class="new">Kiểm tra đơn hàng</a> <br>
                        <a href="https://vanchuyenmy.vn/footer-post/Chinh-sach-bao-hanh-ho-tro" title="" class="new">Chính sách đổi trả</a> <br>
                        <a href="https://vanchuyenmy.vn/footer-post/Cac-dieu-khoan-dieu-kien" title="" class="new">Điều khoản & điều kiện</a>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html> 