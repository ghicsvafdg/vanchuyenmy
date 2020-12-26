<div class="main-header" data-background-color="purple">
    <!-- Logo Header -->
    <div class="logo-header">
        
        <a href="{{route('index')}}" class="logo">
            <img src="{{asset('images/logo_without_text.png')}}" alt="navbar brand" class="navbar-brand" style="width: 75px;">
        </a>
        <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <i class="fa fa-bars"></i>
            </span>
        </button>
        <button class="topbar-toggler more"><i class="fa fa-ellipsis-v"></i></button>
        <div class="navbar-minimize">
            <button class="btn btn-minimize btn-rounded">
                <i class="fa fa-bars"></i>
            </button>
        </div>
    </div>
    <!-- End Logo Header -->
    
    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-expand-lg">
        
        <div class="container-fluid">
            <div class="collapse" id="search-nav">
            </div>
            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                <li class="nav-item dropdown hidden-caret">
                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                        <div class="avatar-sm">
                            @if (Auth::user()->avatar)
                                <img src="{{asset('profile/'.Auth::user()->avatar)}}" alt="image profile" class="avatar-img rounded-circle">
                            @else
                                <img src="{{asset('profile/default_av.png')}}" alt="image profile" class="avatar-img rounded-circle">
                            @endif
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <li>
                            <div class="user-box">
                                <div class="avatar-lg">
                                    @if (Auth::user()->avatar)
                                        <img src="{{asset('profile/'.Auth::user()->avatar)}}" alt="image profile" class="avatar-img rounded">
                                    @else
                                        <img src="{{asset('profile/default_av.png')}}" alt="image profile" class="avatar-img rounded">
                                    @endif
                                    
                                </div>
                                <div class="u-text">
                                    <h4>{{ Auth::user()->username }}</h4>
                                    <p class="text-muted">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{route('user.show',Auth::user()->id)}}">Trang cá nhân</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{route('index')}}">Trang chủ</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logoutt') }}">
                                Logout
                            </a>
                        </li>
                    </ul>
                </li>
                
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</div>
