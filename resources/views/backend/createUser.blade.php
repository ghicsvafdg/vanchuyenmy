@extends('layouts.backend.app')
@section('content')
<div class="card">
    <div class="card-header">
        <h3>Thêm mới người dùng</h3>
    </div>
    <form action="{{route('manage-user.store')}}" method="post">
        @csrf
        <div class="card-body login">
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
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
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
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        <div class="show-password">
                            <i class="flaticon-interface"></i>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label><strong>Trạng thái</strong></label>
                    <br>
                    <input type="radio" name="status" id="" value="1" checked="checked"> Hoạt động &nbsp;
                    <input type="radio" name="status" id="" value="0"> Vô hiệu hóa
                </div>
                <div class="form-group">
                    <label><strong>Vai trò</strong></label>
                    <br>
                    <input type="radio" name="role" id="" value="0"> admin &nbsp;
                    <input type="radio" name="role" id="" value="1" checked="checked"> user
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="form-group">
                <a href="{{route('manage-user.index')}}" class="btn btn-danger">Hủy</a>
                <button type="submit" class="btn btn-primary">Thêm người dùng</button>
            </div>
            
        </div>
    </form>
</div>
@endsection