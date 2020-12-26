<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta charset="utf-8">
    <title>Vanchuyenmy.vn</title>
</head>
<body>
    <div style="background-color: #3399cc; width: 100%;">
        <div style="padding: 0px 135px;">
            <div style="background-color: white;">
                <div style="border-radius:0px;">
                    <div>
                        <div class="infor_email" style=" display: flex; padding: 30px 70px;">
                        <div class="email_icon">
                            <a class="navbar-brand" href="index.html"><img src="{{ $message->embed('assets/img/final-logo.png') }}" style="width: 250px; height: 65px;"></a>
                        </div>
                    </div>
                    <div>
                        <div style="font-size: 25px; color: #3399cc; padding-top: 20px; text-align: center; border-bottom: 2px solid #ff6633; box-shadow: 2px 5px 30px #888888;">
                            <div><b>{{$title}}</b></div> 
                            <br>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div style="padding: 20px 70px;">
                        Kính chào Quý khách,
                        <br> 
                        <br>
                        {!!$content!!}
                    </div>
                </div>
            </div>
            
            <div>
                <div style="padding: 20px 70px;">
                    <p>
                        Mọi thắc mắc và góp ý, Quý khách vui lòng liên hệ với chúng tôi qua:
                    </p>
                    Email hỗ trợ: <a href="#" title="" class="new"> support@weshop.com.vn</a> hoặc
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
</body>
</html> 