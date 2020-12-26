@extends('layouts.frontend.app')
@section('content')

<div class="wrapper">
    <!-- Navbar Header -->
    {{-- <div class="header">
        <div class="nav_top">
            <div class="container">
                <div class="row" >      
                    <div class="col-12 col-md-4 col-sm-4">
                        <div class="nav_top_left">
                            <a href="#">Hotline: 0978.485.015</a>
                        </div>
                    </div>
                    
                    <div class="col-12 col-sm-8 col-md-8 ">
                        <div class="nav_top_right">
                            <ul class="top-menu">
                                <li><a href="#">Tra cứu đơn hàng </a></li>
                                <li><a href="#">Câu hỏi thường gặp </a></li>
                                <li><a href="#">Thông báo </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Navbar content -->
        <div class="" id="navbar">
            <nav class="navbar navbar-expand-lg navbar-dark bg-secondary" >
                <div class="container">
                    <a  class="navbar-brand" href="index.html"> <img src="assets/img/final-logo.png" class="img-fluid" alt="..." style="width: 250px; height: 60px; "></a>
                    <div class="search pr-5">
                        <form class="search-form" action="resultbysearch.html">
                            <input type="text" placeholder="Tìm kiếm..." >
                            <a href="resultbysearch.html"><i class="fa fa-search search-icon" style="padding:13px; margin-top: 9px; background-color:#f09819; color: white; border-radius: 3px;"></i></a>
                        </form>
                    </div>
                    <ul class="navbar-nav navbar-brand">
                        <div class="row">
                            <div class="pt-2 col-6 col-lg-4">
                                <li class="nav-item">
                                    <a class="nav-link"  href="#">Đăng Nhập</a>
                                </li>
                            </div>
                            <div class="pt-2 col-6 col-lg-8">
                                <li class="nav-item">
                                    <div class="cart-icon">
                                        <i class="fas fa-cart-plus" style="margin-right: 5px;"></i>
                                        <a href="#">Giỏ Hàng</a>
                                    </div>
                                </li>
                            </div>
                        </div>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- Navbar content -->
        
        <script>
            window.onscroll = function() {myFunction()};
            
            var navbar = document.getElementById("navbar");
            var sticky = navbar.offsetTop;
            
            function myFunction() {
                if (window.pageYOffset >= sticky) {
                    navbar.classList.add("sticky")
                } else {
                    navbar.classList.remove("sticky");
                }
            }
        </script>
        <!-- end category sticky -->
        
    </div> --}}
    <!-- End-Navbar Header -->
    
    <div class="container">
        <div class="product pt-2 pb-lg-2">
            <!-- breadcum -->
            <div class="row"> 
                
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="#">
                            <a href="index.html"><i class="flaticon-home"></i></a>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Kiểm tra đơn hàng</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    
                </ul>
            </div>
            <!-- end breadcum -->
            <h2 class="pt-4 mx-3"><b>Kiểm tra đơn hàng</b></h2>
            <div class="row py-3 mx-3" id="stamp-check-cart">
                <div class="col-lg-4 col-12 pl-0">
                    <div class="card px-2 py-3">
                        <div class="box-check-cart">
                            <div class="text-center">
                                <h5><i class="mr-1 pb-2 fas fa-search"></i><b>Kiểm tra đơn hàng của bạn</b></h5>
                            </div>
                            <p class="pl-2">Phương thức kiểm tra</p>
                            <form action="{{route('list-cart')}}" method="get">
                                {{-- @csrf --}}
                                <div class="form-check">
                                    <label class="form-radio-label">
                                        <input class="form-radio-input" type="radio" name="option1" value="0"  checked>
                                        <span class="form-radio-sign">Số điện thoại</span>
                                    </label>
                                    <label class="form-radio-label ml-3">
                                        <input class="form-radio-input" type="radio" name="option1" value="1">
                                        <span class="form-radio-sign">Email</span>
                                    </label>
                                </div>
                                
                                {{-- <form action="/action_page.php" class="was-validated"> --}}
                                    <div class="form-group">  
                                        <label for="email2">Số điện thoại/Email</label>
                                        <input type="text"  name="data"  placeholder="" class="form-control @error('data') is-invalid @enderror" display=false required value="" >
                                        @error('data')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}: {{ old('data') }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    {{-- </form> --}}
                                    <p class="pl-2">
                                        Nếu quý khách có bất kỳ thắc mắc nào, xin vui lòng gọi 0888.227.837
                                    </p>
                                    <div class="text-right pb-3 pr-5">
                                        {{-- <a href="{{route('list-cart')}}">  --}}
                                            <button type="submit" class="btn-gradient18" style="width: 200x; ">Xem ngay</button> 
                                            {{-- </a> --}}
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> 
                        
                        <div class="col-lg-4 col-12 pt-2" style="background-color: white;  border-right: 3px solid white;">
                            <p style="border-left: 3px solid #f09819; padding-left: 5px;"><b>Mã đơn hàng</b></p>
                            {{-- @foreach ($user as $item) --}}
                            <div class="row">
                                <div class="col-5 text-right" id="grey-text-infor">
                                    <p>Họ và tên:</p>
                                </div>
                                
                                <div class="col-7 px-0">
                                    <p></p>
                                </div>
                            </div>
                            
                            
                            <div class="row">
                                <div class="col-5 text-right" id="grey-text-infor">
                                    <p>Số điện thoại:</p>
                                </div>
                                <div class="col-7 px-0">
                                    <p></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5 text-right" id="grey-text-infor">
                                    <p>Email:</p>
                                </div>
                                <div class="col-7 px-0">
                                    <p></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5 text-right" id="grey-text-infor">
                                    <p>Địa chỉ:</p>
                                </div>
                                <div class="col-7 px-0">
                                    <p></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5 text-right" id="grey-text-infor">
                                    <p>Trạng thái:</p>
                                </div>
                                <div class="col-7 px-0">
                                    <p><span style="color: #b9232e;"></i></a></p>
                                </div>
                            </div>   
                            {{-- @endforeach --}}
                        </div>
                        <div class="col-lg-4 col-12  pt-2" style="background-color: white; ">
                            <div class="row px-2 px-lg-4">
                                <table class="table table-striped mb-4">
                                    {{-- <thead >
                                        <tr >
                                            <th colspan="2"><a href="productpage.html">Máy hút chân không ikl4ud8h</a></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style=""><a href="productpage.html"><img class="img-fluid" style="width: 45px;" src="assets/img/meat_2.png" alt="Chania"></a></td>
                                            <td>
                                                <div class="" id="final-price">
                                                    <p id="p1">289.000đ</p> 
                                                    <p id="p2">299.000đ</p>   
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody> --}}
                                </table>
                                <table class="table table-striped">
                                    {{-- <thead>
                                        <tr>
                                            <th colspan="2"><a href="productpage.html">Máy hút chân không ikl4ud8h</a></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><a href="productpage.html"><img class="img-fluid" style="width: 45px;" src="assets/img/meat_2.png" alt="Chania"></a></td>
                                            <td>
                                                <div class="" id="final-price">
                                                    <p id="p1">289.000đ</p> 
                                                    <p id="p2">299.000đ</p>   
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody> --}}
                                </table>
                            </div>
                        </div>
                    </div> 
                    
                </div>
            </div>
            <!--COMPUTER FOOTER-->
            <div class="px-0 col-sm-12 col-12 d-none d-lg-block" >
                <div class="text-center" id="main-footer-computer">
                    <div class="container">
                        <div class="row">
                            <div class="py-5 col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                <img src="assets/img/store.jpg" alt="" style="width:150px; height:150px; padding-bottom: 20px;">
                                <div class="col">
                                    <button type="button" class="btn btn-warning">TÌM CỬA HÀNG</button>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row">
                                    <div class="text-left px-0  py-5 col-xs-2 col-sm-2 col-md-2 col-lg-4">
                                        <div class="col" style="height: 30px; ">
                                            <a  href="#" style="color: #000;"><b>LIÊN HỆ</b></a>
                                        </div>
                                        <div class="col">
                                            <div class="text-footer">
                                                <a  href="#" ><p>Liên hệ Quảng Cáo</p></a>
                                                <a  href="#" ><p>Đối tác</p></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-left px-0 py-5 col-xs-2 col-sm-2 col-md-2 col-lg-4">
                                        <div class="col" style="height: 30px;">
                                            <a  href="#" style="color: #000;"><b>CHÍNH SÁCH KHÁCH HÀNG</b></a>
                                        </div>
                                        <div class="col">
                                            <div class="text-footer">
                                                <a  href="#" ><p>Chế độ ưu đãi</p></a>
                                                <a  href="#" ><p>Chính sách mua bán</p></a>
                                                <a  href="#" ><p></p></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-left px-0  py-5 col-xs-2 col-sm-2 col-md-2 col-lg-4">
                                        <div class="col" style="height: 30px;">
                                            <a  href="#" style="color: #000;"><b>THÔNG TIN HỮU ÍCH</b></a>
                                        </div>
                                        <div class="col">
                                            <div class="text-footer">
                                                <a  href="#" ><p>FAQS</p></a>
                                                <a  href="#" ><p>Chính sách chung</p></a>
                                                <a  href="#" ><p>Tra cứu đơn hàng</p></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="text-left px-0  py-5 col-xs-2 col-sm-2 col-md-2 col-lg-3">
                                <div class="col" style="height: 30px;">
                                    <a  href="#" style="color: #000;;"><b>THẺ PHỔ BIẾN</b></a>
                                </div>
                                <div class="col">
                                    <div class="text-footer">
                                        <button type="button" class="btn-btn-footer">Thể thao</button>
                                        <button type="button" class="btn-btn-footer">Làm đẹp</button>
                                        <button type="button" class="btn-btn-footer">Gia dụng</button>
                                        <button type="button" class="btn-btn-footer">Công nghệ</button>
                                        <button type="button" class="btn-btn-footer">Giải trí</button>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                    <div class="py-4 text-center" id="copyright-company">
                        <p>VanChuyenMy.vn - một sản phẩm của VESTA GLOBAL</p>
                        <p>Giấy chứng nhận Đăng ký doanh nghiệp số: 0107797701 do Sở Kế hoạch và Đầu tư Tp Hà Nội cấp ngày 23/5/2015.</p>
                        <p> Hotline: 0911333222, Email: support@vanchuyenmy.vn</p>
                    </div>
                </div>
            </div>
            <!--END COMPUTER FOOTER-->
            <!--MOBILE FOOTER-->
            <div class="col-sm-12 d-block d-lg-none">
                <div class="jumbotron" style="background-color: #f09819;">
                    <div class="col-12" style="padding-bottom: 20px;">
                        <div class="row">
                            
                            <nav class="navbar navbar-expand-lg navbar-light bg-light" style="width: 100%;">
                                <a class="navbar-brand" style="color: white;" href="#"><h4>SẢN PHẨM</h4></a>
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent6" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                    <i class="fas fa-angle-down"></i>
                                </button>
                                
                                <div class="collapse navbar-collapse" id="navbarSupportedContent6">
                                    <ul class="navbar-nav mr-auto">
                                        
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Thời trang & phụ kiện</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Thời trang nam</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Saleoff</a>
                                        </li>
                                        
                                        
                                    </ul>
                                    
                                </div>
                            </nav>
                        </div>
                        
                    </div>
                    <div class="col-12" style="padding-bottom: 20px; " >
                        <div class="row" >
                            
                            <nav class="navbar navbar-expand-lg navbar-light bg-light" style="width: 100%;">
                                <a class="navbar-brand" style="color: white;" href="#"><h4>VỀ CÔNG TY</h4></a>
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent7" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                    <i class="fas fa-angle-down"></i>
                                </button>
                                
                                <div class="collapse navbar-collapse" id="navbarSupportedContent7">
                                    <ul class="navbar-nav mr-auto">
                                        
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Liên hệ Quảng Cáo</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Đối tác</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Đại lý</a>
                                        </li>
                                        
                                        
                                    </ul>
                                    
                                </div>
                            </nav>
                        </div>
                        
                    </div>
                    <div class="col-12" style="padding-bottom: 20px;">
                        <div class="row">
                            
                            <nav class="navbar navbar-expand-lg navbar-light bg-light" style="width: 100%;">
                                <a class="navbar-brand" style="color: white;" href="#"><h4>HỖ TRỢ</h4></a>
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent8" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                    <i class="fas fa-angle-down"></i>
                                </button>
                                
                                <div class="collapse navbar-collapse" id="navbarSupportedContent8">
                                    <ul class="navbar-nav mr-auto">
                                        
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">FAQS</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Chính sách chung</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Tra cứu đơn hàng</a>
                                        </li>
                                        
                                        
                                    </ul>
                                    
                                </div>
                            </nav>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
            <!--END MOBILE FOOTER-->
            
            <!-- slider -->
            <script>
                $('#duc_carousel').owlCarousel({
                    loop:true,
                    margin:10,
                    responsiveClass:true,
                    responsive:{
                        0:{
                            items:1,
                            nav:true
                        },
                        600:{
                            items:3,
                            nav:false
                        },
                        1000:{
                            items:5,
                            nav:true,
                            loop:false
                        }
                    }
                })
            </script>
            
            <script>
                $('#duc_2carousel').owlCarousel({
                    loop:true,
                    margin:10,
                    responsiveClass:true,
                    responsive:{
                        0:{
                            items:1,
                            nav:true
                        },
                        600:{
                            items:3,
                            nav:false
                        },
                        1000:{
                            items:5,
                            nav:true,
                            loop:false
                        }
                    }
                })
            </script>
            
            
            
            <script>
                $('#duc_5carousel').owlCarousel({
                    loop:true,
                    margin:10,
                    responsiveClass:true,
                    responsive:{
                        0:{
                            items:1,
                            nav:true
                        },
                        600:{
                            items:3,
                            nav:false
                        },
                        1000:{
                            items:5,
                            nav:true,
                            loop:false
                        }
                    }
                })
            </script>
            
            <!--COUNTDOWN-->
            <script>
                // Set the date we're counting down to
                var countDownDate = new Date("Jan 5, 2021 0:37:25").getTime();
                
                // Update the count down every 1 second
                var x = setInterval(function() {
                    
                    // Get today's date and time
                    var now = new Date().getTime();
                    
                    // Find the distance between now and the count down date
                    var distance = countDownDate - now;
                    
                    // Time calculations for days, hours, minutes and seconds
                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                    
                    // Output the result in an element with id="demo"
                    document.getElementById("demo").innerHTML = hours + "H "
                    + minutes + "M " + seconds + "S ";
                    
                    // If the count down is over, write some text 
                    if (distance < 0) {
                        clearInterval(x);
                        document.getElementById("demo").innerHTML = "EXPIRED";
                    }
                }, 1000);
            </script>
            <!--END- COUNTDOWN-->
            <!--   Core JS Files   -->
            <script src="assets/js/core/jquery.3.2.1.min.js"></script>
            <script src="assets/js/core/popper.min.js"></script>
            <script src="assets/js/core/bootstrap.min.js"></script>
            
            <!-- jQuery UI -->
            <script src="assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
            <script src="assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
            
            <!-- jQuery Scrollbar -->
            <script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
            
            <!-- Moment JS -->
            <script src="assets/js/plugin/moment/moment.min.js"></script>
            
            <!-- Chart JS -->
            <script src="assets/js/plugin/chart.js/chart.min.js"></script>
            
            <!-- jQuery Sparkline -->
            <script src="assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>
            
            <!-- Chart Circle -->
            <script src="assets/js/plugin/chart-circle/circles.min.js"></script>
            
            <!-- Datatables -->
            <script src="assets/js/plugin/datatables/datatables.min.js"></script>
            
            <!-- Bootstrap Notify -->
            <script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
            
            <!-- Bootstrap Toggle -->
            <script src="assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
            
            <!-- jQuery Vector Maps -->
            <script src="assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
            <script src="assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>
            
            <!-- Google Maps Plugin -->
            <script src="assets/js/plugin/gmaps/gmaps.js"></script>
            
            <!-- Sweet Alert -->
            <script src="assets/js/plugin/sweetalert/sweetalert.min.js"></script>
            
            <!-- Azzara JS -->
            <script src="assets/js/ready.min.js"></script>
            @endsection