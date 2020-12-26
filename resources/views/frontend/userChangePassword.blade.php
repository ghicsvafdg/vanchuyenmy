@extends('layouts.frontend.app')
@section('content')
<div class="pb-2 pt-2 container">
    <div class="page-header">
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
                    <a href="#">Đổi mật khẩu</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                
            </ul>
        </div>
        <!-- end breadcum -->
        
        {{-- user avatar --}}
        @include('layouts.frontend.userInfoAva')
        {{-- end user avatar --}}
        
        <div class="row">
            <!-- left category -->
            @include('layouts.frontend.userCategory')
            <!-- eND left category -->
            
            <div class="card col-lg-9 col-12 mt-4" style="height: 72%">
                <div class="row no-gutters" >
                    <div class="px-2 pt-3 col-md-12" >
                        <h3 style="border-left: 3px solid #f09819; padding-left:5px;"><b>Thay đổi mật khẩu </b></h3>
                        <hr width=100%>
                        <!-- <img src="assets/img/tick.png" class="card-img" alt="..." style="padding:10px; width: 70px; height:70px;" > -->
                    </div>
                    <div class="col-12">
                        @if (Auth::user()->provider_id)
                            <b>Tài khoản quý khách đang được xác thực qua facebook\Goole nên không thể đổi mật khẩu!</b>
                        @else
                        <div class="private-information">
                            <form method="POST" action="{{ route('update-password') }}">
                                @csrf
                                <div class="row">
                                    <div class="px-0 col-12 pl-0">
                                        <div class="row">
                                            <div class="text-right col-4 col-lg-3" style=" margin-top: 20px;">
                                                Mật khẩu hiện tại *
                                            </div>
                                            <div class="col-lg-6 col-7 px-0">
                                                <div class="form-group">   
                                                    <input type="password" class="form-control" name="old_password" required autofocus>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="text-right  col-4 col-lg-3" style="  margin-top: 20px;">
                                                Mật khẩu mới *
                                            </div>
                                            <div class="col-lg-6 col-7 px-0">
                                                <div class="form-group">                   
                                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autofocus>
                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="text-right  col-4 col-lg-3" style="  margin-top: 20px;">
                                                Nhập lại mật khẩu mới *
                                            </div>
                                            <div class="col-lg-6 col-7  px-0">
                                                <div class="form-group">
                                                    <input type="password" class="form-control" name="password_confirmation" required autofocus>
                                                </div>
                                            </div>
                                        </div>
                                    </div>    
                                </div>
                                <!-- button -->
                                <div class="py-3 col-md-12" id="multiple-button">
                                    <button type="submit" class="btn-gradient17" style="width: 200x; margin-left:60px;">Xác nhận</button>
                                </div>
                                <!-- end button -->
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection