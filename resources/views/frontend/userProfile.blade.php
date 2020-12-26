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
                    <a href="#">Trang cá nhân</a>
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
            <!-- left category -->
            @include('layouts.frontend.userCategory')
            <!-- end left category -->
            <div class="card col-lg-9 col-12 mt-4">
                <div class="row no-gutters">
                    <div class="px-2 pt-3 col-md-12">
                        <h3 style="border-left: 3px solid #f09819; padding-left:5px;"><b>Thông tin cá nhân </b></h3>
                        <hr width=100%>
                    </div>
                    <div class="col-12">
                        <div class="private-information">
                            <form action="{{route('user.update',Auth::user()->id)}}" method="post">
                                @csrf
                                @method('patch')
                                <div class="row">
                                    <div class="px-0 col-12 pl-0">
                                        <div class="row">
                                            <div class="text-right col-3" style=" margin-top: 20px;">
                                                Họ và tên *
                                            </div>
                                            <div class="col-6 px-0">
                                                <div class="form-group">   
                                                    <input type="text" class="form-control" value="{{$user->name}}" name="name" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="text-right col-3 pl-0" style="  margin-top: 20px;">
                                                Điện thoại *
                                            </div>
                                            <div class="col-6 px-0">
                                                <div class="form-group">                   
                                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" value="{{$user->phone}}" name="phone" required>
                                                    @error('phone')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}: {{ old('phone') }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="text-right col-3 pl-0" style="  margin-top: 20px;">
                                                Email *
                                            </div>
                                            <div class="col-6 px-0">
                                                @if($user->email)
                                                <br>
                                                <i><b>{{$user->email}}</b></i>
                                                @else
                                                <div class="form-group">
                                                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="" required>
                                                    @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}: {{ old('email') }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row py-2">
                                            <div class="text-right pt-1 col-lg-3 col-4">
                                                Ngày sinh * 
                                            </div>
                                            <div class="col-lg-9 col-7">
                                                <div class="row pl-2">
                                                    <input id="datepicker" width="300" name="dob" value="{{$user->dob}}" readonly/>
                                                    <script>
                                                        $('#datepicker').datepicker({
                                                            format: 'dd/mm/yyyy',
                                                        });
                                                    </script>
                                                    <p class="pl-3 pt-2" style="color: rgb(187, 187, 187); margin-bottom: 2px;"><i>Cập nhập thông tin ngày sinh để nhận được nhiều ưu đãi </i></p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        {{-- gender --}}
                                        <div class="row">
                                            <div class="text-right col-3 pl-0" style="  margin-top: 20px;">
                                                Giới tính *
                                            </div>
                                            @if ($user->gender == 0)
                                            <div class="col-6 px-0 pt-3 pb-2 pl-3">
                                                <label class="form-radio-label">
                                                    <input class="form-radio-input" type="radio" name="gender" value="0"  checked>
                                                    <span class="form-radio-sign">Nam</span>
                                                </label>
                                                <label class="form-radio-label ml-3">
                                                    <input class="form-radio-input" type="radio" name="gender" value="1">
                                                    <span class="form-radio-sign">Nữ</span>
                                                </label>
                                            </div>
                                            @else
                                            <div class="col-6 px-0 pt-3 pb-2 pl-3">
                                                <label class="form-radio-label">
                                                    <input class="form-radio-input" type="radio" name="gender" value="0">
                                                    <span class="form-radio-sign">Nam</span>
                                                </label>
                                                <label class="form-radio-label ml-3">
                                                    <input class="form-radio-input" type="radio" name="gender" value="1" checked>
                                                    <span class="form-radio-sign">Nữ</span>
                                                </label>
                                            </div>
                                            @endif
                            
                                        </div>
                                        {{-- end gender --}}
                                    </div>    
                                </div>
                                <div class="py-3 col-md-12" id="multiple-button">
                                    <button type="submit" class="btn-gradient17" style="width: 200x; margin-left:60px;">Cập nhật</button>
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