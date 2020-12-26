
<body style="background-color: #3399cc;">
    <div class="wrapper">
        <div class="container">
            <div class="row" >
                <div class="col"></div>
                <div class="col-12 col-sm-8" style="background-color: white;">
                    <div class="card" style="border-radius:0px;">
                        <div class="card-content">
                            <div class="row row-demo-grid"></div>
                            <br>
                            <br>
                            <div class="row row-demo-grid">
                                <div class="col-4">   
                                    <div class="mr-5" >
                                        <p title="Load more" style="color: #999999;">Account: {{$quotation->username}}</p>
                                    </div>
                                </div>
                                
                                <div class="col-4 text-center">
                                    Địa chỉ: {{$quotation->address}}
                                </div>
                                
                                <div class="col-4">
                                    <div class="row text-center">
                                        <p class="ml-5"> <i class="mt-1 mr-1 fas fa-phone-square"></i> <span style="color: #ff6633;">{{$quotation->phone}}</span> </p>
                                    </div>
                                </div>
                                
                            </div>
                            <br>
                            <br>
                            <br>
                            <div class="card">
                                <div class="card-body" style="font-size: 20px; color: #3399cc; text-align: center; border-bottom: 2px solid #ff6633; box-shadow: 2px 5px 30px #888888;">
                                    <b>THÔNG TIN ĐƠN HÀNG BÁO GIÁ</b>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="row row-demo-grid">
                                <div class="col-11">
                                    <div class="col-12 text-left">
                                        Kính chào Quý khách <a href="">{{$quotation->email}}</a>
                                        <br> 
                                        <br>
                                        chân thành cảm ơn quý khách đã mua sắm tại <a href="https://vanchuyenmy.vn/">VanChuyenMy.vn</a>
                                        <br>    
                                        <br>                                    
                                        Chúng tôi hy vọng Quý khách hài lòng với trải nghiệm mua sắm và các sản phẩm đã chọn.
                                        <br>
                                        <a href="https://vanchuyenmy.vn/">VanChuyenMy.vn</a> vừa nhận được thông tin báo giá sản phẩm của quý khách với nội dung như sau:
                                        <br>
                                        <br>
                                    </div>
                                </div>
                                <div class="col-1"> 
                                </div>
                            </div>
                            
                            <div class="row row-demo-grid">
                                <div class="col-1"> </div>
                                <div class="card col-10" style="border: 1px solid #999999; border-radius:0%;">
                                    <div class="row">
                                        
                                        <div class="col text-center">
                                            <br> 
                                            <b>ĐỊA CHỈ GIAO HÀNG</b>
                                            <p>Họ và tên: {{$quotation->username}}</p>
                                            <p>Địa chỉ: {{$quotation->address}}</p>
                                            <p>Số điện thoại: {{$quotation->phone}}</p>
                                            <p>Email: <a href="#" title="" class="new">{{$quotation->email}}</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1"></div>
                            </div>
                            <div class="row row-demo-grid">
                                <div class="col-1"> </div>
                                <div class="card col-10 pb-3" style="border: 1px solid #999999; border-radius:0%;">
                                    <div>
                                        <br>
                                        <h2>CHI TIẾT ĐƠN HÀNG</h2>
                                        <br>
                                        <h5>Sản phẩm yêu cầu hỏi giá: <a href="{{$quotation->link_product}}">{{$quotation->link_product}}</a></h5><br>
                                        <h5>Mô tả sản phẩm quý khách cung cấp: {{$quotation->product_info}}</h5>
                                    </div>
                                </div>
                                <div class="col-1"></div>
                            </div>
                            <div class="row row-demo-grid">
                                <div class="col-1"> </div>
                                <div class="card col-10 pb-3" style="border: 1px solid #999999; border-radius:0%;">
                                    <div>
                                        <br>
                                        <h2>TRẢ LỜI CỦA CỬA HÀNG</h2>
                                        <br>
                                        {!!$quotation->reply!!}
                                    </div>
                                </div>
                                <div class="col-1"></div>
                            </div>
                            <div class="row row-demo-grid">     
                                <div class="col-11">
                                    <div class=" col-12 text-left">
                                        <p >
                                            Mọi thắc mắc và góp ý, Quý khách vui lòng liên hệ với chúng tôi qua:
                                        </p>
                                        
                                        Email hỗ trợ :<a href="#" title="" class="new"> hotro.vanchuyenmy@gmail.com</a> hoặc
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
                                    <div class="col-1"> 
                                    </div>
                                </div>
                            </div>
                            
                            <div style="padding: 30px 70px;">
                                <a href="https://vanchuyenmy.vn/check-cart" title="" class="new">Kiểm tra đơn hàng</a> <br>
                                <a href="https://vanchuyenmy.vn/footer-post/Chinh-sach-bao-hanh-ho-tro" title="" class="new">Chính sách đổi trả</a> <br>
                                <a href="https://vanchuyenmy.vn/footer-post/Cac-dieu-khoan-dieu-kien" title="" class="new">Điều khoản & điều kiện</a>
                            </div> 
                        </div>
                        <img src="assets/img/unnamed.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
