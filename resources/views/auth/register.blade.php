<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Đăng ký</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <meta charset="utf-8">
    <link rel="icon" href="{{asset('images/logo_without_text.png')}}" type="image/x-icon"/>
    
    <!-- Fonts and icons -->
    <script src="{{asset('assets/js/plugin/webfont/webfont.min.js')}}"></script>
    <script>
        WebFont.load({
            google: {"families":["Open+Sans:300,400,600,700"]},
            custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"], urls: ['{{asset('assets/css/fonts.css')}}']},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    
    <!-- CSS Files -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/azzara.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
</head>
<body class="login">
    <div class="head-bar" id="header">
        <div class="container" >
            <div class="row" id="header-login">
                <div>
                    <a class="navbar-brand" id="logo-login" href="{{route('index')}}">
                        <img src="{{asset('assets/img/final-logo.png')}}" class="img-fluid" alt="..." style="width: 250px; height: 60px;">
                    </a>
                </div>
                <div class="register-btn d-lg-block d-none">
                    <a href="{{route('register')}}" class="btn-gradient21">Đăng ký tài khoản</a>
                </div>
            </div>
        </div>
    </div>
    <div class="main-login">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12 px-0">
                    <div class="card px-lg-5 py-5" id="card-login">
                        <h3 class="text-center pb-4">Đăng ký</h3>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="login-form">
                                <div class="form-group">
                                    <label for="username" class="placeholder"><b>Tên đăng nhập</b></label>
                                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                                    
                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email" class="placeholder"><b>Email</b></label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="passwordsignin" class="placeholder"><b>Mật khẩu</b></label>
                                    <div class="position-relative">
                                        <input id="passwordsignin" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="show-password">
                                            <i class="flaticon-interface"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="confirmpassword" class="placeholder"><b>Nhập lại mật khẩu</b></label>
                                    <div class="position-relative">
                                        <input id="confirmpassword" type="password" class="form-control" name="password_confirmation" required>
                                        <div class="show-password">
                                            <i class="flaticon-interface"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-action">
                                    <div class="col-md-6">
                                        <a href="{{route('login')}}" id="show-signin" class="btn btn-danger btn-link w-100 fw-bold">Hủy</a>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary w-100 fw-bold">
                                            Đăng ký
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-6 px-0 d-lg-block d-none">
                    <img src="{{asset('assets/img/background-login.jpg')}}" class="img-fluid" alt="..." style="height: 670px;" >
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('assets/js/core/jquery.3.2.1.min.js')}}"></script>
    <script src="{{asset('assets/js/core/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
    
    <!-- jQuery UI -->
    <script src="{{asset('assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js')}}"></script>
    <script src="{{asset('assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js')}}"></script>
    
    <!-- Bootstrap Notify -->
    <script src="{{asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
    
    <!-- Bootstrap Toggle -->
    <script src="{{asset('assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js')}}"></script>

    <!-- Sweet Alert -->
    <script src="{{asset('assets/js/plugin/sweetalert/sweetalert.min.js')}}"></script>
    
    <!-- Azzara JS -->
    <script src="{{asset('assets/js/ready.min.js')}}"></script>

    {{-- code status --}}
    @if (session('success'))
    <script>
        var mess = '{{session('success')}}';
        $.notify({
            // options
            icon: 'fa fa-bell',
            title: 'Thành công',
            message: mess,
        },
        {
            // settings
            element: 'body',
            position: null,
            type: "success",
            allow_dismiss: true,
            newest_on_top: false,
            placement: {
                from: "top",
                align: "center"
            },
            offset: 20,
            spacing: 10,
            z_index: 1031,
            template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
                '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
                '<span data-notify="icon"></span> ' +
                '<span data-notify="title">{1}</span> ' +
                '<span data-notify="message">{2}</span>' +
                '<div class="progress" data-notify="progressbar">' +
                    '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                    '</div>' +
                    '<a href="{3}" target="{4}" data-notify="url"></a>' +
                    '</div>' 
                });      
    </script>
    @elseif(session('error'))
    <script>
        var mess = '{!!session('error')!!}';
        $.notify({
            // options
            icon: 'fa fa-bell',
            title: 'Thất bại',
            message: mess,
        },
        {
            // settings
            element: 'body',
            position: null,
            type: "danger",
            allow_dismiss: true,
            newest_on_top: false,
            placement: {
                from: "top",
                align: "center"
            },
            offset: 20,
            spacing: 10,
            z_index: 1031,
            template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
                '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
                '<span data-notify="icon"></span> ' +
                '<span data-notify="title">{1}</span> ' +
                '<span data-notify="message">{2}</span>' +
                '<div class="progress" data-notify="progressbar">' +
                    '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                    '</div>' +
                    '<a href="{3}" target="{4}" data-notify="url"></a>' +
                    '</div>' 
                });      
    </script>
    @endif
    {{-- code status end --}}
</body>
</html>


