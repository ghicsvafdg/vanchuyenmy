@extends('layouts.frontend.app')
@section('content')
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
                    <a href="#">Thiết lập địa chỉ</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
            </ul>
        </div>
        <!-- end breadcum -->
        {{-- avatar --}}
        @include('layouts.frontend.userInfoAva')
        {{-- end avatar --}}
        <div class="row">
            @include('layouts.frontend.userCategory')
            <div class="card col-9 mt-4">
                <div class="row no-gutters">
                    <div class="px-2 pt-3 col-md-12" >
                        <h3 style="border-left: 3px solid #f09819; padding-left:5px;"><b>Sửa Thông tin địa chỉ giao hàng</b></h3>
                        <hr width=100%>
                    </div>
                    <div class="col-12">
                        <div class="private-information">
                            <form action="{{route('manage-address.update',$address->id)}}" method="post">
                                @csrf
                                @method('patch')
                                <div class="row">
                                    <div class="px-0 col-12 pl-0">
                                        <div class="row">
                                            <div class="text-right col-4 pl-0" style=" margin-top: 20px;">
                                                Họ và tên *
                                            </div>
                                            <div class="col-6 px-0">
                                                <div class="form-group">   
                                                    <input type="text" class="form-control" value="{{$address->name}}" name="name" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="text-right col-4 pl-0" style="margin-top: 20px;">
                                                Điện thoại *
                                            </div>
                                            <div class="col-6 px-0">
                                                <div class="form-group">                   
                                                    <input type="text" class="form-control" value="{{$address->phone}}" name="phone" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="text-right col-4 pl-0" style="margin-top: 20px; ">
                                                Tỉnh / TP *
                                            </div>
                                            <div class="col-6 px-0">
                                                <div class="form-group">
                                                    <select id="country" name="province" class="form-control" style="margin-top: 5px;" required>
                                                        <option value="" selected disabled>Chọn Tỉnh/Thành phố</option>
                                                        @foreach($provinces as $key => $province)
                                                        <option value="{{$key}}"> {{$province}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="text-right col-4 pl-0" style="margin-top: 20px;" >
                                                Quận / Huyện *
                                            </div>
                                            <div class="col-6 px-0">
                                                <div class="form-group">
                                                    <select name="district" id="state" class="form-control" style="margin-top: 5px;" required>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="text-right col-4 pl-0" style="margin-top: 20px;">
                                                Phường / Xã *
                                            </div>
                                            <div class="col-6 px-0">
                                                <div class="form-group">
                                                    <select name="ward" id="city" class="form-control" style="margin-top: 5px;" required>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="text-right col-4 pl-0" style="margin-top: 20px;">
                                                Địa chỉ chi tiết *
                                            </div>
                                            <div class="col-6 px-0">
                                                <div class="form-group">
                                                    <textarea class="form-control" aria-label="With textarea" name="note" required>{{$address->note}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>    
                                </div>
                                <div class="py-3 col-md-12" id="multiple-button">
                                    <button type="submit" class="btn-gradient17" style="width: 200x; margin-left:60px;">Lưu địa chỉ</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection