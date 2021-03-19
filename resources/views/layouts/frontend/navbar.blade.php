<div class="header">
    <div class="nav_top">
        <div class="container">
            <div class="row" >      
                <div class="col-12 col-md-4 col-sm-4">
                    <div class="nav_top_left">
                        @foreach ($footerPost as $post)
                        @if ($post->category == 2)
                        <i class="mr-1 fas fa-phone"></i> Hotline: {{$post->title}}
                        @endif
                        @endforeach
                    </div>
                </div>
                
                <div class="col-12 col-sm-8 col-md-8">
                    <div class="nav_top_right">
                        <ul class="top-menu">
                            <li><p><a href="{{route('check-cart')}}">Tra cứu đơn hàng</li></p></a>
                            <li>
                                @foreach ($footerPost as $post)
                                @if ($post->category == 4)
                                <p><a href="{{route('footer-post.show',$post->slug)}}" >
                                    Câu hỏi thường gặp
                                </a></p>
                                @endif
                                @endforeach
                            </li>
                            <li>
                                @foreach ($footerPost as $post)
                                @if ($post->category == 5)
                                <p><a href="{{route('footer-post.show',$post->slug)}}" >
                                    Thông báo
                                </a></p>
                                @endif
                                @endforeach
                            </li>                     
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar content -->
    <div id="navbar">
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <div class="container">
                <a class="navbar-brand" href="{{route('index')}}">
                    <img src="{{asset('assets/img/final-logo.png')}}" class="img-fluid lazyload" alt="..." style="width: 200px; height: 55px;">
                </a>
                <div class="d-lg-none d-block">
                    <button class="openbtn" onclick="openNav()">☰</button> 
                </div>
                <div class="dropdown5 d-lg-block d-none">
                    <button class="dropbtn5" style="font-size: 16px;">Danh mục
                        <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-content5">
                        @foreach ($categories as $category)
                        <div class="column-cate">
                            <a href="{{route('danh-muc',$category->slug)}}"><i class="{{$category->icon}}" style="color: #f09819; margin-right: 15px; margin-top: 2px; font-size: 20px;"></i>{{$category->title}}</a>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="search">
                    <form class="search-form" action="{{route('search-product')}}">
                        <input type="text" name="search" value="@isset($search){{$search}}@endisset" placeholder="Tìm kiếm...">
                        <button type="submit" class="btn-search"><i class="fa fa-search search-icon" ></i></button>
                    </form>
                </div>
                <ul class="navbar-nav navbar-brand">
                    <div class="row">
                        @if (Auth::check())
                        <div class="pt-2 col-6 col-lg-4">
                            <li class="nav-item dropdown hidden-caret">
                                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                                    <div class="avatar-sm">
                                        @if (Auth::user()->avatar)
                                        <object data="{{asset('profile/'.Auth::user()->avatar)}}" class="avatar-img rounded-circle" type="image/png">
                                            <img src="{{Auth::user()->avatar}}" alt="image profile" class="avatar-img rounded-circle lazyload">
                                        </object>
                                        @else
                                        <img src="{{asset('profile/default_av.png')}}" alt="image profile" class="avatar-img rounded-circle lazyload">
                                        @endif
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-user animated fadeIn">
                                    <li>
                                        <div class="user-box">       
                                            <div class="avatar-lg">
                                                @if (Auth::user()->avatar)
                                                <object data="{{asset('profile/'.Auth::user()->avatar)}}" class="avatar-img rounded" type="image/png">
                                                    <img src="{{Auth::user()->avatar}}" alt="image profile" class="avatar-img rounded lazyload">
                                                </object>
                                                @else
                                                <img src="{{asset('profile/default_av.png')}}" alt="image profile" class="avatar-img rounded lazyload">
                                                @endif
                                            </div>
                                            <div class="u-text">
                                                <h4>
                                                    Xin chào 
                                                    @if (isset(Auth::user()->username))
                                                    {{ Auth::user()->username }}
                                                    @elseif(isset(Auth::user()->name))
                                                    {{ Auth::user()->name }}
                                                    @elseif(isset(Auth::user()->email))
                                                    {{ Auth::user()->email }}
                                                    @endif
                                                </h4>
                                            </div>
                                        </div>
                                    </li>
                                    <li id="line-notice">
                                        @if (Auth::user()->role == 0)
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{url('/home')}}">Trang quản trị</a>
                                        @endif
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{route('user.show',Auth::user()->id)}}">Trang cá nhân</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{route('order.show',Auth::user()->id)}}">Lịch sử đơn hàng</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{url('dia-chi')}}">Thiết lập địa chỉ</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{route('user.edit',Auth::user()->id)}}">Đổi mật khẩu</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ route('logoutt') }}">Đăng xuất</a>
                                    </li>
                                </ul>
                            </li>
                        </div>
                        <div class="pt-2 col-6 col-lg-8">
                            <li>
                                <div class="dropdown">
                                    <div class="text-left" id="notice-cart">
                                        <button class="dropbtn"> 
                                            <i class="fas fa-cart-plus" style="margin-right: 5px;"></i>
                                            Giỏ hàng
                                        </button>
                                        <span class="notification">{{$cartlist}}</span>
                                    </div>
                                    <div class="dropdown-main-content">
                                        <div class="col py-3">
                                            Sản phẩm mới thêm
                                        </div>
                                        @foreach ($cart as $ct)
                                        <div class="row pl-2 pb-3 mx-1" id="hover-cart">
                                            <div class="col-2 pr-0">
                                                <img src="{{asset('images/'.json_decode($ct->proInCart->filename)[0])}}"  class="img-fluid lazyload" alt="..." width="90px" height="90px;">
                                            </div>
                                            <div class="col-10">
                                                <div class="row">
                                                    <div class="col-9">
                                                        <a class="ellipsis2" href="{{route('detail-product',$ct->proInCart->slug)}}" style="width:230px;">{{$ct->proInCart->name}}</a>
                                                    </div>
                                                    <div class="col-3">
                                                        <p style="color:#f09819;">
                                                            @if ($ct->proInCart->promotion)
                                                            {{number_format($ct->proInCart->promotion*$ct->quantity*1000, 0, ',', ' ')}}đ
                                                            @else
                                                            {{number_format($ct->proInCart->price*$ct->quantity*1000, 0, ',', ' ')}}đ
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-9" id="clasify">
                                                        @isset($ct->color)
                                                        {{$ct->color}} 
                                                        @endisset
                                                        @isset($ct->size)
                                                        {{$ct->size}}
                                                        @endisset
                                                    </div>
                                                    <div class="col-3">
                                                        @if (Request::is('thanh-toan') || Request::is('saving-data') || Request::is('saving-order'))
                                                            
                                                        @else
                                                        <form action="{{route('cart.destroy',$ct->id)}}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn-btn-delete" type="submit"><i class="mr-1 fas fa-trash-alt"></i>Xóa</button>
                                                        </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        <div class="row pl-2 pb-3 mx-1" id="check-cart">
                                            <a href="{{route('cart.index')}}" class="btn-gradient20 btn">Xem giỏ hàng</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </div>
                        @else
                        <div class="pt-2 col-6 col-lg-4">
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('login')}}">ĐĂNG NHẬP</a>
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
                        @endif
                    </div>
                </ul>
            </div>
        </nav>
    </div>
    <!-- Navbar content -->
</div>

<!-- POLICY & RULE -->
<div class="container">
    <div class="product pt-2 pb-lg-2">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-6">
                
                <div class="row no-gutters">
                    <div class="px-2 col-md-4">
                        <img src="{{asset('assets/img/delivery-services.gif')}}" class="card-img lazyload"alt="..." style="padding:10px; width: 70px; height:70px;">
                    </div>
                    <div class="py-0" style="margin-top: 20px;">
                        <h5><b>HỖ TRỢ VẬN CHUYỂN</b></h5>
                        <p>Với đơn hàng trên 500.000</p>
                    </div>
                    
                </div>
                
            </div>
            <div class="col-lg-3 col-md-6 col-6">
                <div class="row no-gutters">
                    <div class="px-2 col-md-4">
                        <img src="{{asset('assets/img/tick.png')}}" class="card-img lazyload" alt="..." style="padding:10px; width: 70px; height:70px;" >
                    </div>
                    <div class="py-0" style="margin-top: 20px;">
                        <h5><b>CAM KẾT CHÍNH HÃNG</b></h5>
                        <p>Đảm bảo chất lượng 100%</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-6">
                <div class="row no-gutters">
                    <div class="px-2 col-md-4">
                        <img src="{{asset('assets/img/money_change.png')}}" class="card-img lazyload" alt="..." style="padding:10px; width: 70px; height:70px;" >
                    </div>
                    
                    <div class="py-0" style="margin-top: 20px;">
                        <h5><b>CHÍNH SÁCH & ĐỔI TRẢ</b></h5>
                        <p>Đổi trả hàng trong 7 ngày</p>
                    </div>
                    
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-6">
                <div class="row no-gutters">
                    <div class="px-2 col-md-4">
                        <img src="{{asset('assets/img/clock.png')}}" class="card-img lazyload" alt="..." style="padding:10px; width: 70px; height:70px;" >
                    </div>
                    
                    <div class="py-0" style="margin-top: 20px;">
                        <h4><b>HỖ TRỢ 24/7</b></h4>
                        <p>Thứ 2-Thứ 7: 9h-18h</p>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End POLICY & RULE -->