<div class="py-4 col-3 d-lg-block d-none">
    <div class="list-group" id="text-hidden-category">
        <a href="{{route('user.show',Auth::user()->id)}}" class="list-group-item list-group-item-action" style="margin: 5px 5px 0px 0px; color: #f09819;">
            <b><i class="fas fa-user"></i> Thông tin tài khoản</b>
        </a>
        <a href="{{route('user.show',Auth::user()->id)}}" class="list-group-item list-group-item-action">
            <i class="fas fa-circle" style="margin-right: 3px;margin-top: 7px; font-size: 6px;"></i>Thông tin cá nhân
        </a>
        <a href="{{route('user.edit',Auth::user()->id)}}" class="list-group-item list-group-item-action">
            <i class="fas fa-circle" style="margin-right: 3px;margin-top: 7px; font-size: 6px;"></i>Thay đổi mật khẩu
        </a>
        <a class="list-group-item list-group-item-action" style="margin: 5px 5px 0px 0px; color: #f09819;">
            <i class="fas fa-file-invoice-dollar"></i> &nbsp; Quản lý mua hàng
        </a>
        <a href="{{route('order.show',Auth::user()->id)}}" class="list-group-item list-group-item-action">
            <i class="fas fa-circle" style="margin-right: 3px;margin-top: 7px; font-size: 6px;"></i>Lịch sử đơn hàng
        </a>
        <a href="{{url('dia-chi')}}" class="list-group-item list-group-item-action">
            <i class="fas fa-circle" style="margin-right: 3px;margin-top: 7px; font-size: 6px;"></i>Thiết lập địa chỉ
        </a>
        <a href="{{route('logoutt')}}" class="list-group-item list-group-item-action">
            <i class="fas fa-circle" style="margin-right: 3px;margin-top: 7px; font-size: 6px;"></i>Đăng xuất
        </a>
    </div>
</div>