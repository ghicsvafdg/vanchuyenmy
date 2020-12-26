<div class="row">
    <div class="col pl-0">
        <div class="pl-2" >
            <div class="px-0 col-lg-12 d-none d-lg-block"> 
                <div class="row pt-3">
                    <div class="col-4 pr-0 col-md-3">
                        <div class="nav flex-column nav-pills nav-secondary nav-pills-no-bd nav-pills-icons" id="v-pills-tab-with-icon" role="tablist" aria-orientation="vertical" style="">
                            <a class="nav-link @if((isset($method) && $method == 4) || !isset($method)) active @endif" id="v-pills-home-tab-icons" data-toggle="pill" href="#v-pills-home-icons" role="tab" aria-controls="v-pills-home-icons" aria-selected="true" style="height:80px;">
                                <div class="pt-1 row">                                            
                                    <div class="col" id="category-title">
                                        <p>Thanh toán trực tiếp</p>
                                        <p>tại nhà của quý khách(COD)</p>
                                    </div>  
                                </div>
                            </a>
                            <a class="nav-link @if(isset($method) && $method == 3) active @endif" id="v-pills-profile-tab-icons" data-toggle="pill" href="#v-pills-profile-icons" role="tab" aria-controls="v-pills-profile-icons" aria-selected="false" style="height:80px;"> 
                                <div class="pt-1 row">                                            
                                    <div class="col" id="category-title">
                                        <p>Thanh toán trực tiếp </p>
                                        <p>tại Văn phòng VanchuyenMy </p>  
                                    </div>  
                                </div>
                            </a>
                            <a class="nav-link @if(isset($method) && ($method == 1 || $method == 2)) active @endif" id="v-pills-cod-tab-icons" data-toggle="pill" href="#v-pills-cod-icons" role="tab" aria-controls="v-pills-cod-icons" aria-selected="false" style="height:80px;"> 
                                <div class="pt-1 row">                                            
                                    <div class="col" id="category-title">
                                        <p>Chuyển khoản trực tiếp </p>
                                        <p>cho VanchuyenMy</p>
                                    </div>  
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-8 col-md-9" >
                        <div class="tab-content" id="v-pills-with-icon-tabContent">
                            <!-- thanh toán COD -->
                            <div class="tab-pane fade @if((isset($method) && $method == 4) || !isset($method)) show active @endif" id="v-pills-home-icons" role="tabpanel" aria-labelledby="v-pills-home-tab-icons">
                                <div class="pr-2 pl-0 col">
                                    <input type="radio" name="method" value="4" @if(isset($method) && $method == 4) checked @endif class="form-radio">
                                    <label>Xác nhận chọn phương thức này</label>
                                    <div class="pt-2">
                                        <h4> <b>Thông tin thu tiền tại nhà:</b></h4>  
                                    </div>

                                    @include('frontend.infoPrice')

                                    <div class=" px-4 row" id="paying-COD">
                                        <p>Nhân Viên VanChuyenMy sẽ đến nhận thanh toán trước tại địa chỉ quý khách yêu cầu, hình thức này chỉ áp dụng cho Tp.Hà Nội và Hà Nam.</p>
                                        <p>Phí thu tiền tại nhà: <b>30,000 đ</b></p>
                                    </div>
                                </div>
                            </div>
                            <!-- End thanh toán COD -->

                            <!-- thanh toán tại văn phòng -->
                            <div class="tab-pane fade @if(isset($method) && $method == 3) show active @endif" id="v-pills-profile-icons" role="tabpanel" aria-labelledby="v-pills-profile-tab-icons">
                                <div class="pr-2 pl-0 col">
                                    <input type="radio" name="method" value="3" @if(isset($method) && $method == 3) checked @endif class="form-radio">
                                    <label>Xác nhận chọn phương thức này</label>
                                    <div class="pt-2">
                                        <h4> <b>Thông tin đóng tiền mặt:</b></h4>  
                                    </div>

                                    @include('frontend.infoPrice')

                                    <div class="pt-2 px-4 row">
                                        <p>- Quý khách vui lòng đến trực tiếp tại một trong các địa chỉ sau để thực hiện thanh toán:</p>
                                    </div>
                                    <div class=" px-4 row">
                                        <p><b>TP. Hà Nội: </b>Số 32-Lô A11-Khu đô thị Lê Trọng Tấn, An Khánh, Hoài Đức, Hà Nội</p>
                                        <p><b>Hà Nam:</b> Phố Cà, Thanh Nguyên, Thanh Liêm (gần cây xăng Phố Cà)</p>
                                    </div>
                                </div>     
                            </div>
                            <!-- end thanh toán tại văn phòng -->
                            
                            <!-- Chuyển khoản trực tiếp -->
                            <div class="tab-pane fade @if(isset($method) && ($method == 1 || $method == 2)) show active @endif" id="v-pills-cod-icons" role="tabpanel" aria-labelledby="v-pills-cod-tab-icons">
                                <div class="pr-2 pl-0 col">
                                    <div class="paying-method">
                                        <h5>Quý Khách có thể chuyển khoản bằng Internet Banking, tại máy ATM hoặc Quầy giao dịch ngân hàng, hoặc chuyển khoản qua điện thoại. </h5>
                                        <h5>* Lưu ý: Vui lòng chuyển tiền chính xác theo thông tin tài khoản ngân hàng và nội dung chuyển khoản. Sẽ được hiển thị sau khi quý khách hoàn click Xác nhận đặt hàng bên dưới</h5>
                                        <h5>- Đơn hàng được thanh toán tại máy ATM, vì không thể ghi chú nội dung thanh toán nên qúy khách vui lòng thông báo qua email hoặc gọi trực tiếp tổng đài Fado để được hỗ trợ</h5>
                                        <h5>- Đơn hàng được của quý khách chỉ được xác nhận thanh toán sau khi Fado nhận được thông báo từ Ngân hàng với nội dung thanh toán đầy đủ. Bất cập: một số Ngân hàng không hỗ trợ kiểm tra sau 19h00: Agribank, Đông Á, Sacombank, Vietinbank,...</h5>
                                    </div>
                                    <div class="pt-3">
                                        <h4> <b>1, Quý khách muốn thanh toán trước:</b></h4>
                                    </div>
                                    <input type="radio" name="method" value="1" id="radio-one" class="form-radio" @if(isset($method) && $method == 1) checked @endif required>
                                    <label for="radio-one">
                                        <h4><b>Thanh toán toàn bộ chi phí đơn hàng</b></h4>
                                    </label>

                                    @include('frontend.infoPrice')

                                    <input type="radio" name="method" value="2" @if(isset($method) && $method == 2) checked @endif class="form-radio"><label><h4><b>Thanh toán trước 50% giá trị đơn hàng</b></h4></label>
                                    <div class="mt-3 content">
                                        <div class="py-2 px-4">
                                            <div class="col-12 py-2 " id="warning">
                                                <p> <i class="fas fa-exclamation-triangle" style="color: #f09819;"></i> Nếu quý khách thanh toán trước 50%. VanChuyenMy sẽ cộng thêm phí bù trừ thanh toán: 2.2% của tổng giá sản phẩm trong đơn hàng của quý khách.</p>
                                            </div>
                                        </div>
                                        <div class="py-2 px-4 row">
                                            <div class="text-left col">
                                                Số tiền được giảm từ mã giảm giá:
                                            </div>
                                            @if (isset($code) && !isset($error))
                                                @if ($code->role == 0)
                                                    <div class="text-right col">
                                                        <p>{{number_format(($sum-(($sum*$code->amount)/100))*1000)}} đ</p>
                                                    </div>
                                                @elseif($code->role == 1)
                                                    <div class="text-right col">
                                                        <p>{{number_format(($sum-$code->amount)*1000)}} đ</p>
                                                    </div>
                                                @endif
                                            @else
                                                <div class="text-right col">
                                                    <p>0 đ</p>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="py-2 px-4 row">
                                            <div class="text-left col">
                                                Tổng giá trị đơn hàng:
                                            </div>
                                            @if (isset($code) && !isset($error))
                                                @if ($code->role == 0)
                                                    <div class="text-right col" style="color: #f09819;">
                                                        <p><b>{{number_format(($sum-(($sum*$code->amount)/100))*1000)}} đ</b></p>
                                                    </div>
                                                @elseif($code->role == 1)
                                                    <div class="text-right col" style="color: #f09819;">
                                                        <p><b>{{number_format(($sum-$code->amount)*1000)}} đ</b></p>
                                                    </div>
                                                @endif
                                            @else    
                                                <div class="text-right col" style="color: #f09819;">
                                                    <p><b>{{$sum}}.000 đ</b></p>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="px-4 mb-2 row" id="text-sum-cost">
                                            <div class="text-left col-9">
                                                <p>Số tiền cần được thanh toán trước:</p>
                                            </div>
                                            @if (isset($code) && !isset($error))
                                                @if ($code->role == 0)
                                                    <div class="text-right col-3" style="color: #f09819;">
                                                        <p><b>{{number_format((($sum-(($sum*$code->amount)/100))/2)*1000)}} đ</b></p>
                                                    </div>
                                                @elseif($code->role == 1)
                                                    <div class="text-right col-3" style="color: #f09819;">
                                                        <p><b>{{number_format((($sum-$code->amount)/2)*1000)}} đ</b></p>
                                                    </div>
                                                @endif
                                            @else    
                                                <div class="text-right col-3" style="color: #f09819;">
                                                    <p><b>{{number_format(($sum/2)*1000)}} đ</b></p>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="pb-2 px-4 row" id="text-sum-cost">
                                            <div class="text-left col">
                                                <p><b>Còn lại phải thanh toán:</b></p>
                                            </div>
                                            @if (isset($code) && !isset($error))
                                                @if ($code->role == 0)
                                                    <div class="text-right col" style="color: #f09819;">
                                                        <p><b>{{number_format((($sum-(($sum*$code->amount)/100))/2)*1000)}} đ</b></p>
                                                    </div>
                                                @elseif($code->role == 1)
                                                    <div class="text-right col" style="color: #f09819;">
                                                        <p><b>{{number_format((($sum-$code->amount)/2)*1000)}} đ</b></p>
                                                    </div>
                                                @endif
                                            @else    
                                                <div class="text-right col" style="color: #f09819;">
                                                    <p><b>{{number_format(($sum/2)*1000)}} đ</b></p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="pt-3">
                                        <h4> <b>2, Vui lòng chọn ngân hàng thanh toán:</b></h4>
                                    </div>
                                    <div class="py-2 mx-4 infor-banking" style="border-bottom: 1px solid rgb(223, 220, 220);">
                                        <div class="row">
                                            <div class="col-4">
                                                <img class="img-fluid" src="assets/img/vietcombank2.jpg" alt="Chania" style="margin-right: 25px; height: 50px;  border: 1px solid rgb(223, 220, 220); border-radius: 3px; ">
                                            </div>
                                            <div class="col-8" id="credit-card">
                                                <p> <b>Ngân hàng Vietcombank</b></p>
                                                <p> Số tài khoản: <b>0451000318769</b></p>
                                                <p> Chủ tài khoản: <b>DANG HAI TRUONG</b></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="py-2 mx-4 infor-banking" style="border-bottom: 1px solid rgb(223, 220, 220);">
                                        <div class="row">
                                            <div class="col-4">
                                                <img class="img-fluid" src="assets/img/sea_bank.jpg" alt="Chania" style="margin-right: 25px; height: 50px;  border: 1px solid rgb(223, 220, 220); border-radius: 3px; ">
                                            </div>
                                            <div class="col-8" id="credit-card">
                                                <p> <b>Ngân hàng Tmcp Đông Nam Á</b></p>
                                                <p> Số tài khoản: <b>000000900976</b></p>
                                                <p> Chủ tài khoản: <b>DANG HAI TRUONG</b></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="py-2 mx-4 infor-banking" style="border-bottom: 1px solid rgb(223, 220, 220);">
                                        <div class="row">
                                            <div class="col-4">
                                                <img class="img-fluid" src="assets/img/maritimebank.jpg" alt="Chania" style="margin-right: 25px; height: 50px;  border: 1px solid rgb(223, 220, 220); border-radius: 3px; ">
                                            </div>
                                            <div class="col-8" id="credit-card">
                                                <p> <b>Ngân hàng TMCP Hàng Hải Việt Nam</b></p>
                                                <p> Số tài khoản: <b>03101012001047</b></p>
                                                <p> Chủ tài khoản: <b>DANG HAI TRUONG</b></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End chuyển khoản trực tiếp -->
                        </div>
                        <div class="warning2 py-2 px-4">
                            <p><b>Lưu ý:</b> VanChuyenMy đảm bảo giá sản phẩm không thay đổi trong vòng 60 phút. Căn cứ vào thời điểm quý khách [Xác nhận đặt hàng] thành công.
                                Đối với giao dịch phát sinh từ 22h, VanChuyenMy sẽ xử lý sau 8h sáng ngày hôm sau. Quý khách vui lòng lựa chọn thanh toán online để được giữ giá đã chọn
                            </p>
                        </div>
                        <div class="pt-3 px-3 row">
                            <label class="checkbox-inline mr-2 mt-1"><input type="checkbox" value="" checked></label>
                            <p>Đồng ý với <a href="#"> Điều khoản & điều kiện </a> giao dịch của VanChuyenMy </p>
                        </div>
                        <div class="pl-5  col-3">
                            <button type="submit" name="action" value="paymoney" class="btn-gradient15" style="width: 500x; margin-left:60px;">
                                Xác nhận đặt hàng 
                                <i class="fas fa-angle-double-right"></i>
                            </button>  
                        </div>
                    </div>
                </div>
            </div>
            <!-- Các phương thức thanh toán hiển thị điện thoại-->
            <div class="px-0 col-sm-12 d-block d-lg-none">
                <!-- Mã giảm giá -->
                <div class="py-3">
                    <div class="col-12">
                        <div class="row pl-2">
                            <div class="pt-3 mt-1"><b><i>Mã giảm giá</i></b></div>
                            <div id="code-discount">
                                <div class="form-group form-floating-label">
                                    @if (isset($code) && !isset($error))
                                    <input id="inputFloatingLabel1" type="text" name="voucher" class="form-control input-border-bottom" value="{{$code->code}}">
                                    <label for="inputFloatingLabel1" class="placeholder"> <i class="mr-2 fas fa-ticket-alt" style="color: #f09819;"></i><i>Sử dụng mã giảm giá</i></label>
                                    @else
                                    <input id="inputFloatingLabel1" type="text" name="voucher" class="form-control input-border-bottom" value="">
                                    <label for="inputFloatingLabel1" class="placeholder"> <i class="mr-2 fas fa-ticket-alt" style="color: #f09819;"></i><i>Sử dụng mã giảm giá</i></label>
                                    @endif
                                </div>
                            </div>
                            <div>
                                <button type="submit" name="action" value="voucher" class="mt-3 btn-gradient18" style="width: 200x;">Áp dụng</button>
                            </div>
                        </div>
                    </div>
                    <div class="col"  style="color: rgb(119, 197, 1);">
                        @if (isset($code) && !isset($error))
                            @if ($code->role == 0)
                            <div class="col"  style="color: rgb(119, 197, 1);">
                                Giá giảm: - {{$code->amount}}%
                            </div>
                            @elseif($code->role == 1)
                            <div class="col"  style="color: rgb(119, 197, 1);">
                                Giá giảm: - {{$code->amount}}.000đ
                            </div>
                            @endif
                        @endif
                    </div>
                </div>
                <!-- END Mã giảm giá -->
                <ul class="nav nav-pills nav-secondary  nav-pills-no-bd nav-pills-icons justify-content-center" id="pills-tab-with-icon" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab-icon" data-toggle="pill" href="#pills-home-icon" role="tab" aria-controls="pills-home-icon" aria-selected="true">
                            <div class="width: 50px">
                                <p>Thanh toán COD</p>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-profile-tab-icon" data-toggle="pill" href="#pills-profile-icon" role="tab" aria-controls="pills-profile-icon" aria-selected="false">
                            <p>Thanh toán trực tiếp</p> 
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-contact-tab-icon" data-toggle="pill" href="#pills-contact-icon" role="tab" aria-controls="pills-contact-icon" aria-selected="false">
                            Chuyển khoản trực tiếp
                        </a>
                    </li>
                </ul>
                <div class="tab-content mt-2 mb-3" id="pills-with-icon-tabContent">
                    <div class="tab-pane fade @if((isset($method) && $method == 4) || !isset($method)) show active @endif" id="pills-home-icon" role="tabpanel" aria-labelledby="pills-home-tab-icon">
                        <input type="radio" name="method" value="4" @if(isset($method) && $method == 4) checked @endif class="form-radio">
                        <label>Xác nhận chọn phương thức này</label>
                        <div class="pr-2 pl-0 col">
                            <div class="pt-2">
                                <h4> <b>Thông tin thu tiền tại nhà:</b></h4>  
                            </div>

                            @include('frontend.infoPrice')

                            <div class=" px-4 row" id="paying-COD">
                                <p>Nhân Viên VanChuyenMy sẽ đến nhận thanh toán trước tại địa chỉ quý khách yêu cầu, hình thức này chỉ áp dụng cho Tp.Hà Nội và Hà Nam.</p>
                                <p>Phí thu tiền tại nhà: <b>30,000 đ</b></p>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade @if(isset($method) && $method == 3) show active @endif" id="pills-profile-icon" role="tabpanel" aria-labelledby="pills-profile-tab-icon">
                        <input type="radio" name="method" value="3" @if(isset($method) && $method == 3) checked @endif class="form-radio">
                        <label>Xác nhận chọn phương thức này</label>
                        <div class="pr-2 pl-0 col">
                            <div class="pt-2">
                                <h4> <b>Thông tin đóng tiền mặt:</b></h4>  
                            </div>

                            @include('frontend.infoPrice')
                            
                            <div class="pt-2 px-4 row">
                                <p>- Quý khách vui lòng đến trực tiếp tại một trong các địa chỉ sau để thực hiện thanh toán:</p>
                            </div>
                            <div class=" px-4 row">
                                <p><b>TP. Hà Nội: </b>Số 32-Lô A11-Khu đô thị Lê Trọng Tấn, An Khánh, Hoài Đức, Hà Nội</p>
                                <p><b>Hà Nam:</b> Phố Cà, Thanh Nguyên, Thanh Liêm (gần cây xăng Phố Cà)</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="tab-pane fade @if(isset($method) && ($method == 1 || $method == 2)) show active @endif" id="pills-contact-icon" role="tabpanel" aria-labelledby="pills-contact-tab-icon">
                        <div class="pr-2 pl-0 col" >
                            <div class="paying-method">
                                <h5>Quý Khách có thể chuyển khoản bằng Internet Banking, tại máy ATM hoặc Quầy giao dịch ngân hàng, hoặc chuyển khoản qua điện thoại. </h5>
                                <h5>* Lưu ý: Vui lòng chuyển tiền chính xác theo thông tin tài khoản ngân hàng và nội dung chuyển khoản. Sẽ được hiển thị sau khi quý khách hoàn click Xác nhận đặt hàng bên dưới</h5>
                                <h5>- Đơn hàng được thanh toán tại máy ATM, vì không thể ghi chú nội dung thanh toán nên qúy khách vui lòng thông báo qua email hoặc gọi trực tiếp tổng đài Fado để được hỗ trợ</h5>
                                <h5>- Đơn hàng được của quý khách chỉ được xác nhận thanh toán sau khi Fado nhận được thông báo từ Ngân hàng với nội dung thanh toán đầy đủ. Bất cập: một số Ngân hàng không hỗ trợ kiểm tra sau 19h00: Agribank, Đông Á, Sacombank, Vietinbank,...</h5>
                            </div>
                            <div class="pt-3">
                                <h4> <b>1, Quý khách muốn thanh toán trước:</b></h4>
                            </div>
                            <input type="radio" name="method" value="1" id="radio-one" class="form-radio" @if(isset($method) && $method == 1) checked @endif required>
                            <label>Xác nhận chọn phương thức này</label>

                            @include('frontend.infoPrice')

                            <input type="radio" name="method" value="2" @if(isset($method) && $method == 2) checked @endif class="form-radio"><label><h4><b>Thanh toán trước 50% giá trị đơn hàng</b></h4></label>
                            <div class="mt-3 content">
                                <div class="py-2 px-4">
                                    <div class="col-12 py-2 " id="warning">
                                        <p> <i class="fas fa-exclamation-triangle" style="color: #f09819;"></i> Nếu quý khách thanh toán trước 50%. VanChuyenMy sẽ cộng thêm phí bù trừ thanh toán: 2.2% của tổng giá sản phẩm trong đơn hàng của quý khách.</p>
                                    </div>
                                </div>
                                <div class="py-2 px-4 row">
                                    <div class="text-left col">
                                        Số tiền được giảm từ mã giảm giá:
                                    </div>
                                    @if (isset($code) && !isset($error))
                                        @if ($code->role == 0)
                                            <div class="text-right col">
                                                <p>{{number_format(($sum-(($sum*$code->amount)/100))*1000)}} đ</p>
                                            </div>
                                        @elseif($code->role == 1)
                                            <div class="text-right col">
                                                <p>{{number_format(($sum-$code->amount)*1000)}} đ</p>
                                            </div>
                                        @endif
                                    @else
                                        <div class="text-right col">
                                            <p>0 đ</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="py-2 px-4 row">
                                    <div class="text-left col">
                                        Tổng giá trị đơn hàng:
                                    </div>
                                    @if (isset($code) && !isset($error))
                                        @if ($code->role == 0)
                                            <div class="text-right col" style="color: #f09819;">
                                                <p><b>{{number_format(($sum-(($sum*$code->amount)/100))*1000)}} đ</b></p>
                                            </div>
                                        @elseif($code->role == 1)
                                            <div class="text-right col" style="color: #f09819;">
                                                <p><b>{{number_format(($sum-$code->amount)*1000)}} đ</b></p>
                                            </div>
                                        @endif
                                    @else    
                                        <div class="text-right col" style="color: #f09819;">
                                            <p><b>{{$sum}}.000 đ</b></p>
                                        </div>
                                    @endif
                                </div>
                                <div class="px-4 mb-2 row" id="text-sum-cost">
                                    <div class="text-left col-9">
                                        <p>Số tiền cần được thanh toán trước:</p>
                                    </div>
                                    @if (isset($code) && !isset($error))
                                        @if ($code->role == 0)
                                            <div class="text-right col-3" style="color: #f09819;">
                                                <p><b>{{number_format((($sum-(($sum*$code->amount)/100))/2)*1000)}} đ</b></p>
                                            </div>
                                        @elseif($code->role == 1)
                                            <div class="text-right col-3" style="color: #f09819;">
                                                <p><b>{{number_format((($sum-$code->amount)/2)*1000)}} đ</b></p>
                                            </div>
                                        @endif
                                    @else    
                                        <div class="text-right col-3" style="color: #f09819;">
                                            <p><b>{{number_format(($sum/2)*1000)}} đ</b></p>
                                        </div>
                                    @endif
                                </div>
                                <div class="pb-2 px-4 row" id="text-sum-cost">
                                    <div class="text-left col">
                                        <p><b>Còn lại phải thanh toán:</b></p>
                                    </div>
                                    @if (isset($code) && !isset($error))
                                        @if ($code->role == 0)
                                            <div class="text-right col" style="color: #f09819;">
                                                <p><b>{{number_format((($sum-(($sum*$code->amount)/100))/2)*1000)}} đ</b></p>
                                            </div>
                                        @elseif($code->role == 1)
                                            <div class="text-right col" style="color: #f09819;">
                                                <p><b>{{number_format((($sum-$code->amount)/2)*1000)}} đ</b></p>
                                            </div>
                                        @endif
                                    @else    
                                        <div class="text-right col" style="color: #f09819;">
                                            <p><b>{{number_format(($sum/2)*1000)}} đ</b></p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="pt-3">
                                <h4><b>2, Vui lòng chọn ngân hàng thanh toán:</b></h4>
                            </div>
                            <div class="py-2 mx-4 infor-banking" style="border-bottom: 1px solid rgb(223, 220, 220);">
                                <div class="row">
                                    <div class="col-4">
                                        <img class="img-fluid" src="assets/img/vietcombank2.jpg" alt="Chania" style="margin-right: 25px; height: 50px;  border: 1px solid rgb(223, 220, 220); border-radius: 3px; ">
                                    </div>
                                    <div class="col-8" id="credit-card">
                                        <p> <b>Ngân hàng Vietcombank</b></p>
                                        <p> Số tài khoản: <b>0451000318769</b></p>
                                        <p> Chủ tài khoản: <b>DANG HAI TRUONG</b></p>
                                    </div>
                                </div>
                            </div>
                            <div class="py-2 mx-4 infor-banking" style="border-bottom: 1px solid rgb(223, 220, 220);">
                                <div class="row">
                                    <div class="col-4">
                                        <img class="img-fluid" src="assets/img/sea_bank.jpg" alt="Chania" style="margin-right: 25px; height: 50px;  border: 1px solid rgb(223, 220, 220); border-radius: 3px; ">
                                    </div>
                                    <div class="col-8" id="credit-card">
                                        <p> <b>Ngân hàng Tmcp Đông Nam Á</b></p>
                                        <p> Số tài khoản: <b>000000900976</b></p>
                                        <p> Chủ tài khoản: <b>DANG HAI TRUONG</b></p>
                                    </div>
                                </div>
                            </div>
                            <div class="py-2 mx-4 infor-banking" style="border-bottom: 1px solid rgb(223, 220, 220);">
                                <div class="row">
                                    <div class="col-4">
                                        <img class="img-fluid" src="assets/img/maritimebank.jpg" alt="Chania" style="margin-right: 25px; height: 50px;  border: 1px solid rgb(223, 220, 220); border-radius: 3px; ">
                                    </div>
                                    <div class="col-8" id="credit-card">
                                        <p> <b>Ngân hàng TMCP Hàng Hải Việt Nam</b></p>
                                        <p> Số tài khoản: <b>03101012001047</b></p>
                                        <p> Chủ tài khoản: <b>DANG HAI TRUONG</b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="warning2 py-2 px-4" >
                        <p> <b>Lưu ý:</b> VanChuyenMy đảm bảo giá sản phẩm không thay đổi trong vòng 60 phút. Căn cứ vào thời điểm quý khách [Xác nhận đặt hàng] thành công.
                            Đối với giao dịch phát sinh từ 22h, VanChuyenMy sẽ xử lý sau 8h sáng ngày hôm sau. Quý khách vui lòng lựa chọn thanh toán online để được giữ giá đã chọn
                        </p>
                    </div>
                    <div class="pt-3 px-3 row">
                        <label class="checkbox-inline mr-2 mt-1"><input type="checkbox" value="" checked></label>
                        <p>Đồng ý với <a href="#"> Điều khoản & điều kiện </a> giao dịch của VanChuyenMy </p>
                    </div>
                    <div class="pl-lg-5 pl-0 col-3">
                        <button type="submit" name="action" value="paymoney" class="btn-gradient15" style="width: 500x; margin-left:60px;">
                            Xác nhận đặt hàng 
                            <i class="fas fa-angle-double-right"></i>
                        </button>
                    </div>
                </div>
            </div>
            <!-- End hiển thị điện thoại-->
        </div>
    </div>
</div>
