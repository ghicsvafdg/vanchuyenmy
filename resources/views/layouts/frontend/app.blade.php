<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.frontend.head')
    {{-- <style>
        /* ***************
        * FB on left side 
        ******************/
        /* this is for the circle position */
        .fb_dialog.fb_dialog_advanced {
            left: 18pt;
        }

        /* The following are for the chat box, on display and on hide */
        iframe.fb_customer_chat_bounce_in_v2 {
            left: 9pt;
        }
        iframe.fb_customer_chat_bounce_out_v2 {
            left: 9pt;
        }
    </style> --}}
</head>
<body>
    <!-- Load Facebook SDK for JavaScript -->
    <div id="fb-root"></div>
    <script>
        window.fbAsyncInit = function() {
            FB.init({
            xfbml            : true,
            version          : 'v5.0'
            });
        };

        (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <!-- Your customer chat code -->
    <div class="fb-customerchat"
    attribution=setup_tool
    page_id="989977167754093"
    logged_in_greeting="Xin Chào! Chúng tôi có thể giúp gì cho bạn"
    logged_out_greeting="Xin Chào! Chúng tôi có thể giúp gì cho bạn">
    </div>
    
    {{-- main content --}}
    <div class="wrapper">
        <!-- Navbar Header -->
        @include('layouts.frontend.navbar')
        <!-- End Navbar header -->
        
        <!--Menu mobile-->
        @include('layouts.frontend.mobileMenu')
        <!--End Menu mobile-->

        {{-- content here --}}
        @yield('content')
        {{-- end content --}}

        {{-- Yêu cầu báo giá và hỗ trợ --}}
        <div id="mySidenav" class="sidenav d-lg-block d-none">
            <a href="{{route('yeu-cau-bao-gia.index')}}" id="about">YÊU CẦU BÁO GiÁ</a>
            <div class="dropdown2 d-lg-block d-none">
                <button class="dropbtn2">HỖ TRỢ</button>
                <div class="dropdown_content pl-3 py-3">
                    <span style="color: #f09819;">Hỗ trợ khách hàng</span>
                    <div class="row pt-2">
                        <div class="col-3">
                            <img src="{{asset('assets/img/profile.jpg')}}" alt="..." style="width: 40px;" class="avatar-img rounded-circle">
                        </div>
                        <div class="col">
                            <div>ĐẶNG TRƯỜNG</div>
                            <div class="" style="color: #f09819;" ><i class="mr-1 fas fa-phone"></i>0373892381 </div>
                        </div>
                    </div>
                    <div class="row pt-2">
                        <div class="col-3">
                            <img src="{{asset('assets/img/profile.jpg')}}" alt="..." style="width: 40px;" class="avatar-img rounded-circle">
                        </div>
                        <div class="col">
                            <div>THANH TÙNG</div>
                            <div class="" style="color: #f09819;" ><i class="mr-1 fas fa-phone"></i>0373892381 </div>
                        </div>
                    </div>
                    <div class="row pt-2">
                        <div class="col-3">
                            <img src="{{asset('assets/img/female.jpg')}}" alt="..." style="width: 40px;" class="avatar-img rounded-circle">
                        </div>
                        <div class="col">
                            <div>MINH ĐỨC</div>
                            <div class="" style="color: #f09819;" ><i class="mr-1 fas fa-phone"></i>0373892381 </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Yêu cầu báo giá và hỗ trợ --}}

        <!-- Scroll go to top -->
        <a id="button"><i class="fas fa-arrow-up" style="color:white; padding-top:20px;"></i></a>
        <!--End Scroll go to top -->

        <!--COMPUTER FOOTER-->
        @include('layouts.frontend.comFooter')
        <!--end computer footer-->

        <!--mobile footer-->
        @include('layouts.frontend.mobileFooter')
        <!--end mobile footer-->
    </div>
    {{-- end main content --}}

    {{-- <div class="zalo-chat-widget" data-oaid="579745863508352884" 
    data-welcome-message="Rất vui khi được hỗ trợ bạn!" 
    data-autopopup="0" data-width="350" data-height="420"></div>

    <script src="https://sp.zalo.me/plugins/sdk.js"></script> --}}
    <!-- slider -->
    @include('layouts.frontend.script')
</body>
</html>