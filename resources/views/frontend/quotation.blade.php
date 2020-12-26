@extends('layouts.frontend.app')
@section('content')
<div class="py-4 container">              
    
    <!-- breadcum -->
    <div class="row"> 
        
        <ul class="breadcrumbs">
            <li class="nav-home">
                <a href="{{route('index')}}">
                    <a href="index.html"><i class="flaticon-home"></i></a>
                </a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Yêu cầu báo giá</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
        </ul>
    </div>
    <!-- end breadcum -->
    <div class="row py-3 mt-2 px-4" style="border: 1px solid #f09819">
        <div class="col-3">
            <div class="row">
                <div class="col">
                    <div class="text-center">
                        Bước 1
                    </div> 
                    <div class="bc-line text-center">
                        <span></span><span></span><span></span><span class="bc-danger"></span><span></span>
                        <span></span><span></span>
                    </div>
                    <div class="text-center">
                        Khách hàng điền link chi tiết Sản Phẩm muốn mua
                    </div>
                </div>
                <div class="text-center">
                    <div class="icon-preview"><i class="la flaticon-shopping-bag" style="font-size: 35px;"></i></div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="row">
                <div class="col">
                    <div class="text-center">
                        Bước 2
                    </div> 
                    <div class="bc-line text-center">
                        <span></span><span></span><span></span><span class="bc-danger"></span><span></span>
                        <span></span><span></span>
                    </div>
                    <div class="text-center">
                        VanChuyenMy báo giá và & thời gian nhận hàng tại Việt Nam
                    </div>
                </div>
                <div class="text-center">
                    <div class="icon-preview"><i class="la flaticon-box-1" style="font-size: 35px;"></i></div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="row">
                <div class="col">
                    <div class="text-center">
                        Bước 3
                    </div> 
                    <div class="bc-line text-center">
                        <span></span><span></span><span></span><span class="bc-danger"></span><span></span>
                        <span></span><span></span>
                    </div>
                    <div class="text-center">
                        Thanh toán đơn hàng và VanChuyenMy tiến hành mua hàng trong vòng 24 giờ
                    </div>
                </div>
                <div class="text-center">
                    <div class="icon-preview"><i class="la flaticon-coins"  style="font-size: 35px;"></i></div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="row">
                <div class="col">
                    <div class="text-center">
                        Bước 4
                    </div> 
                    <div class="bc-line text-center">
                        <span></span><span></span><span></span><span class="bc-danger"></span><span></span>
                        <span></span><span></span>
                    </div>
                    <div class="text-center">
                        VanChuyenMy giao hàng tận nhà & Thu phí vận chuyển
                    </div>
                </div>
                <div class="text-center">
                    <div class="icon-preview"><i class="la flaticon-delivery-truck" style="font-size: 35px;"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="card my-5">
        <div class="col pt-2 pb-4" id="bar-report-price">
            <b>YÊU CẦU GỬI BÁO GIÁ</b>
        </div>
        <form action="{{route('yeu-cau-bao-gia.store')}}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="row">
                <div class="col-2"></div>
                <div class="col-9">
                    <div class="row">
                        <div class="col-5">
                            <div class="form-group">
                                <input type="text" class="form-control" name="link" placeholder="Đường dẫn sản phẩm bạn muốn mua (*)" value="{{old('link')}}" required>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="Tên sản phẩm" value="{{old('name')}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-10 px-0">
                        <div class="form-group">
                            <textarea class="form-control" name="description"  placeholder="Bạn cho chúng ta tôi biết về size, số lượng, màu sắc, kiểu dáng... (*)" rows="4" required>{{old('description')}}</textarea>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="exampleFormControlFile1">
                                <h4><b>Tập tin chứa thông tin báo giá + Thông tin của quý khách (tùy chọn)</b></h4>
                            </label>
                            <input type="file" class="pt-3 pb-2 form-control-file hidden" name="filename" id="exampleFormControlFile1" >
                            (Hỗ trợ định dạng: .txt, .doc, .dox, .docs, .pdf, .xml, .xls, .xlsx, tối đa 5MB.)
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <a href="{{asset('file/'.$fileSubmit->filename)}}" download class="btn btn-primary btn-sm">Tải file báo giá mẫu tại đây</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col pt-2 pb-4" id="bar-report-price">
                <b>THÔNG TIN NGƯỜI MUA</b>
            </div>
            <div class="row">
                <div class="col-2"></div>
                <div class="col-9 px-0">
                    <div class="row">
                        <div class="col-5">
                            <div class="form-group" id="form-price">   
                                <i class="mt-3 mr-2 fas fa-user"></i>
                                <input type="text" class="form-control" name="username" placeholder="Họ và tên (*)" required value="{{old('username')}}">
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="form-group" id="form-price"> 
                                <i class="mt-3 mr-2 fas fa-map-marker-alt"></i>
                                <input type="text" class="form-control" placeholder="Địa chỉ chi tiết (*)" name="address" required value="{{old('address')}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <div class="form-group" id="form-price">   
                                <i class="mt-3 mr-2 fas fa-phone"></i>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" placeholder="Số điện thoại (*)" name="phone" required value="{{old('phone')}}">
                                <br>
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="pl-4 ml-1 form-group">
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
                        <div class="col-5">
                            <div class="form-group" id="form-price">   
                                <i class="mt-3 mr-2 far fa-envelope"></i> 
                                <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Email (*)" name="email" value="{{old('email')}}" required>
                                <br>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-5">
                            <form action="/action_page.php" class="was-validated">
                                <div class="pl-4 ml-1 form-group">
                                    <select name="district" id="state" class="form-control" style="margin-top: 5px;" required>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5">
                            
                        </div>
                        <div class="col-5">
                            <div class="form-group pl-4 ml-1">
                                <select name="ward" id="city" class="form-control" style="margin-top: 5px;" required>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="py-2" id="category-title">
                        <p><i>(*)Vui lòng nhập đầy đủ các thông tin bắt buộc sau:</i></p>
                        <p><i>- Đường dẫn sản phẩm bạn muốn mua</i></p>
                        <p><i>- Số điện thoại</i></p>
                        <p><i>- Email</i></p>
                    </div>
                    <div class="text-right pb-3">
                        <button type="submit" class="btn-gradient15" style="width: 500x;">Gửi yêu cầu</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection