<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.backend.head')
</head>
<body>
    <div class="wrapper">
        @include('layouts.backend.logo-navbar')
        @include('layouts.backend.sidebar')
        <div class="main-panel">
            <div class="content">
                <div class="page-inner">
                    <div class="page-header">
                        <h4 class="page-title">
                            {{ request()->is('manage-user') ? 'Quản lý người dùng' : '' }}
                            {{ request()->is('manage-post') ? 'Quản lý bài viết' : '' }}
                            {{ request()->is('manage-post-category') ? 'Quản lý danh mục bài viết' : '' }}
                            {{ request()->is('manage-tag') ? 'Quản lý tag' : '' }}
                            {{ request()->is('manage-product') ? 'Quản lý sản phẩm' : '' }}
                            {{ request()->is('manage-product-category') ? 'Quản lý danh mục sản phẩm' : '' }}
                            {{ request()->is('manage-code') ? 'Quản lý mã giảm giá' : '' }}
                        </h4>
                    </div>
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    @include('layouts.backend.script')
    @yield('script')
</body>
</html>