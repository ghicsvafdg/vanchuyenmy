
<div class="sidebar">
    <div class="sidebar-background"></div>
    <div class="sidebar-wrapper scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    @if (Auth::user()->avatar)
                        <img src="{{asset('profile/'.Auth::user()->avatar)}}" alt="image profile" class="avatar-img rounded-circle">
                    @else
                        <img src="{{asset('profile/default_av.png')}}" alt="image profile" class="avatar-img rounded-circle">
                    @endif
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            {{ Auth::user()->username }}
                            <span class="user-level">Administrator</span>
                            <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>
                    
                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="#profile">
                                    <span class="link-collapse">My Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="#edit">
                                    <span class="link-collapse">Edit Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="#settings">
                                    <span class="link-collapse">Settings</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav">
                <li class="nav-item">
                    <a href="{{route('home')}}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                        <span class="badge badge-count">5</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('manage-user') ? 'active' : '' }}">
                    <a href="{{route('manage-user.index')}}">
                        <i class="fas fa-address-card"></i>
                        <p>Người dùng</p>
                    </a>
                </li>
                <li class="nav-item {{ (request()->is('manage-order') || request()->is('manage-order/*')) ? 'active' : '' }}">
                    <a href="{{route('manage-order.index')}}">
                        <i class="fas fa-shopping-cart"></i>
                        <p>Đơn hàng</p>
                    </a>
                </li>
                <li class="nav-item {{ (request()->is('manage-product') || request()->is('manage-product/*') ||
                        request()->is('manage-product-category') || request()->is('manage-product-category/*') ||
                        request()->is('manage-quotation') || request()->is('manage-quotation/*') ||
                        request()->is('manage-code') || request()->is('manage-code/*')) ? 'active' : '' }}">
                    <a href="#product" data-toggle="collapse">
                        <i class="fas fa-tshirt"></i>
                        <p>Sản phẩm</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ (request()->is('manage-product') || request()->is('manage-product/*') ||
                    request()->is('manage-product-category') || request()->is('manage-product-category/*') ||
                    request()->is('manage-quotation') || request()->is('manage-quotation/*') ||
                    request()->is('manage-code') || request()->is('manage-code/*')) ? 'show' : '' }}" id="product">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{route('manage-product-category.index')}}">
                                    <span class="sub-item">Danh mục sản phẩm</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('manage-product.index')}}">
                                    <span class="sub-item">Sản phẩm</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('manage-code.index')}}">
                                    <span class="sub-item">Mã giảm giá</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('manage-quotation.index')}}">
                                    <span class="sub-item">Yêu cầu báo giá</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ (request()->is('manage-post') || request()->is('manage-post/*') ||
                request()->is('manage-post-category') || request()->is('manage-post-category/*') ||
                request()->is('manage-footer-post') || request()->is('manage-footer-post/*')) ? 'active' : '' }}">
                    <a href="#post" data-toggle="collapse">
                        <i class="fas fa-newspaper"></i>
                        <p>Bài viết</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ (request()->is('manage-post') || request()->is('manage-post/*') ||
                        request()->is('manage-post-category') || request()->is('manage-post-category/*') ||
                        request()->is('manage-footer-post') || request()->is('manage-footer-post/*')) ? 'show' : '' }}" id="post">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{route('manage-post-category.index')}}">
                                    <span class="sub-item">Danh mục bài viết</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('manage-post.index')}}">
                                    <span class="sub-item">Bài viết thương mại</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('manage-footer-post.index')}}">
                                    <span class="sub-item">Bài viết giới thiệu</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ request()->is('manage-tag') ? 'active' : '' }}">
                    <a href="{{route('manage-tag.index')}}">
                        <i class="fas fa-hashtag"></i>
                        <p>Tag</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('manage-banner')|| request()->is('manage-banner/*') ? 'active' : '' }}">
                    <a href="{{route('manage-banner.index')}}">
                        <i class="fas fa-file-image"></i>
                        <p>Banner</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('manage-comment') || request()->is('manage-comment/*') ? 'active' : '' }}">
                    <a href="{{route('manage-comment.index')}}">
                        <i class="fas fa-file-image"></i>
                        <p>Nhận xét sản phẩm</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('manage-comments') || request()->is('manage-comments/*') ? 'active' : '' }}">
                    <a href="{{route('manage-comments')}}">
                        <i class="fas fa-file-image"></i>
                        <p>Nhận xét bài viết</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('manage-promotion') ? 'active' : '' }}">
                    <a href="{{route('manage-promotion.index')}}">
                        <i class="fas fa-file-image"></i>
                        <p>Gửi mail khuyến mại</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
