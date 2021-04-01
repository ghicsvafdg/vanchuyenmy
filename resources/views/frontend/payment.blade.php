@extends('layouts.frontend.app')
@section('content')
@if($errors->any())
<h4>{{$errors->first()}}</h4>
@endif
@if (!$user->address->isEmpty())
<div class="py-4 container">
    @if (!isset($code))
        <div class="col-12" style="padding: 10px; border: 1px solid #f09819; background-color: #fffab4;">
            <h5>Nhập Mã giảm giá ở phía bên để hưởng miễn phí vận chuyển bạn nhé!</h5>
        </div>
    @endif
    <br>
    <div class="card">
        <div class="card">
            <form action="{{url('saving-order')}}" method="post">
                @csrf
                <div class="row ml-1">
                    <div class="col-12 col-md-12 col-lg-8">
                        <div class="pt-3 pb-2 px-4 row">
                            <div class="px-0 col-3" id="cart-title">
                                <a href="#" style="color: #f09819"><b> Giỏ hàng của quý khách</b></a>
                            </div>
                            <div class="col-9 text-center" id="header-pay">
                                <h3><b>Thanh toán đơn hàng</b></h3>
                                <p>Cám ơn đã lựa chọn VanChuyenMy để trải nghiệm mua sắm thông minh</p>
                            </div>
                        </div>
                        <div class="row pr-4">
                            <div class="pr-0 col-3 col-lg-2" id="Step">
                                <img src="{{asset('assets/img/arrow.png')}}"  class="img-fluid lazyload" alt="...">
                                <h5>Bước 1</h5>
                            </div>
                            <div class="pl-5 mt-1 col-7 col-lg-8" style=" padding: 10px; background-color: #fffab4">
                                <b style=" color: #f09819;">Quý khách vui lòng cung cấp thông tin mua hàng</b>
                            </div>
                        </div>
                        
                        <div class="row pt-4 px-2">
                            <div class="col-12 col-lg-3" style="color: #f09819; font-size: 16px;">
                                <i class="mr-1 fas fa-map-marker-alt"></i>
                                Địa chỉ nhận hàng
                            </div>
                            <div class="col-12 col-lg-9 pt-lg-0 pt-3" id="change_address">
                                <a href="{{url('tao-dia-chi')}}" class="btn-gradient16" style="width: 500x;"><i class="mr-1 fas fa-plus"></i> Thêm địa chỉ mới</a>
                                <a href="{{url('dia-chi')}}" class="btn-gradient16" style="width: 500x;"> Thiết lập địa chỉ</a>
                            </div>
                        </div>
                        <div class="col-md-12 py-2">
                            <?php $i = 0?>
                            @foreach ($user->address as $address)
                                <div>
                                    <input type="radio" id="add<?= ++$i ?>" name="address" class="form-radio-first" required value="{{$address->id}}" @if(isset($add) && ($add->id == $address->id)) checked @endif>
                                    <label for="add<?= $i ?>">
                                        <b>{{$address->name}} {{$address->phone}}</b> 
                                        {{$address->note.', '.$address->address}}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        
                        @foreach ($cart as $ct)
                        <input type="text" name="carts[]" value="{{$ct->id}}" hidden>
                        @endforeach
                    
                        @foreach ($cart as $ct)
                        @if ($ct->proInCart->promotion)
                            <p hidden>{{$sum += $ct->proInCart->promotion*$ct->quantity}}</p>
                        @else
                            <p hidden>{{$sum += $ct->proInCart->price*$ct->quantity}}</p>
                        @endif
                        @endforeach
                        @if (isset($code) && !isset($error))
                            @if ($code->role == 0)
                            <input type="text" name="price" value="{{$sum-(($sum*$code->amount)/100)}}" hidden>
                            @elseif($code->role == 1)
                            <input type="text" name="price" value="{{$sum-$code->amount}}" hidden>
                            @endif
                        @else
                        <input type="text" name="price" value="{{$sum}}" hidden>
                        @endif
                        <br>
                    
                        <br>
                        <div class="pb-3 row pr-4" style="" >
                            <div class="pr-0 col-3 col-lg-2" id="Step">
                                <img src="assets/img/arrow.png"  class="img-fluid lazyload" alt="...">
                                <h5>Bước 2</h5>
                            </div>
                            <div class="pl-5 mt-1 col-9 col-lg-10" style="padding: 10px; background-color: #fffab4">
                                <b style="color: #f09819;">Vui lòng chọn hình thức thanh toán phù hợp với Quý Khách</b>
                            </div>
                            
                        </div>
                        <div class="col mr-4" style="background-color: #fffab4;  padding: 10px; ">
                            <b>* Lưu ý:</b> Quý khách nên thanh toán ngay để tránh sản phẩm bị tăng giá
                        </div>
                        
                        <!-- Các phương thức thanh toán hiển thị trên máy tính-->
                        @include('layouts.frontend.paymentMethod')
                        {{-- end Các phương thức thanh toán hiển thị trên máy tính --}}

                        @if (isset($code) && !isset($error))
                        <input type="text" name="code" class="form-control input-border-bottom" value="{{$code->code}}" hidden>
                        @endif
                    </div>
                    {{-- side --}}
                    @include('layouts.frontend.sideBill')
                    {{-- end side --}}
                </div>
            </form>
        </div>
    </div>
</div>
@else   
<div class="py-4 container">
    @if (!isset($code))
        <div class="col-12" style="padding: 10px; border: 1px solid #f09819; background-color: #fffab4;">
            <h5>Nhập Mã giảm giá ở phía bên để hưởng miễn phí vận chuyển bạn nhé!</h5>
        </div>
    @endif
    <br>
    <form action="{{url('saving-data')}}" method="post">
        @csrf
        <div class="card">
            <div class="row ml-1">
                <div class="col-12 col-md-12 col-lg-8">
                    <div class="pt-3 pb-2 px-4 row">
                        <div class="px-0 col-3" id="cart-title">
                            <a href="#" style="color: #f09819"><b> Giỏ hàng của quý khách</b></a>
                        </div>
                        <div class="col-9 text-center" id="header-pay">
                            <h3><b>Thanh toán đơn hàng</b></h3>
                            <p>Cám ơn đã lựa chọn VanChuyenMy để trải nghiệm mua sắm thông minh</p>
                        </div>
                    </div>
                    <div class="row pr-4">
                        <div class="pr-0 col-3 col-lg-2" id="Step" >
                            <img src="{{asset('assets/img/arrow.png')}}"  class="img-fluid lazyload" alt="...">
                            <h5>Bước 1</h5>
                        </div>
                        <div class="pl-5 mt-1 col-7 col-lg-8" style="padding: 10px; background-color: #fffab4">
                            <b style="color: #f09819;">Quý khách vui lòng cung cấp thông tin mua hàng</b>
                        </div>
                    </div>
                    
                    @foreach ($cart as $ct)
                    <input type="text" name="carts[]" value="{{$ct->id}}" hidden>
                    @endforeach
                    <div class="private-information">
                        <div class="row">
                            <div class="px-0 col-lg-7 col-12 pl-0">
                                <div class="row">
                                    <div class="text-right col-lg-4 col-3" style="margin-top: 20px;">
                                        Họ và tên *
                                    </div>
                                    <div class="col-lg-8 col-7 px-0">
                                        <div class="form-group">  
                                            @if (isset($name))
                                            <input type="text" class="form-control" placeholder="Nguyễn Văn A" name="name" value="{{$name}}" required>
                                            @elseif(Auth::user()->name)
                                            <input type="text" class="form-control" placeholder="Nguyễn Văn A" name="name" value="{{Auth::user()->name}}" required>
                                            @else
                                            <input type="text" class="form-control" placeholder="Nguyễn Văn A" name="name" value="" required>
                                            @endif 
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="text-right col-lg-4 col-3" style="margin-top: 20px;">
                                        Điện thoại *
                                    </div>
                                    <div class="col-lg-8 col-7 px-0">
                                        <div class="form-group">  
                                            @if (isset($phone))
                                                <input type="text" class="form-control @error('phone') is-invalid @enderror" placeholder="Nguyễn Văn A" name="phone" value="{{$phone}}" required>
                                                @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}: {{old('phone')}} </strong>
                                                </span>
                                                @enderror
                                            @elseif(Auth::user()->phone)
                                                <input type="text" class="form-control @error('phone') is-invalid @enderror" placeholder="Nguyễn Văn A" name="phone" value="{{Auth::user()->phone}}" required>
                                                @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}: {{old('phone')}} </strong>
                                                </span>
                                                @enderror
                                            @else
                                                <input type="text" class="form-control @error('phone') is-invalid @enderror" placeholder="Nguyễn Văn A" name="phone" value="" required>
                                                @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}: {{old('phone')}} </strong>
                                                </span>
                                                @enderror
                                            @endif                  
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="text-right col-lg-4 col-3" style="margin-top: 20px;">
                                        Email *
                                    </div>
                                    <div class="col-lg-8 col-7 px-0">
                                        <div class="form-group">
                                            <input type="email" class="form-control" placeholder="abcd@gmail.com" name="gmail" value="{{Auth::user()->email}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="text-right col-lg-4 col-3" style="margin-top: 20px; ">
                                        Tỉnh / TP *
                                    </div>
                                    <div class="col-lg-8 col-7 px-0">
                                        @if (isset($province))
                                        <input type="text" name="provincess" value="{{$province->id}}" hidden>
                                        <div class="form-group">
                                            <select id="country" name="province" class="form-control" style="margin-top: 5px;" required>
                                            <option value="{{$province->id}}" selected>{{$province->name}}</option>
                                            @foreach($provinces as $key => $province)
                                            <option value="{{$key}}"> {{$province}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                        @else
                                        <div class="form-group">
                                            <select id="country" name="province" class="form-control" style="margin-top: 5px;" required>
                                            <option value="" selected disabled>Chọn Tỉnh/Thành phố</option>
                                            @foreach($provinces as $key => $province)
                                            <option value="{{$key}}"> {{$province}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="text-right col-lg-4 col-3" style="margin-top: 20px;" >
                                        Quận / Huyện *
                                    </div>
                                    <div class="col-lg-8 col-7 px-0">
                                        @if (isset($district))
                                        <input type="text" name="districtt" value="{{$district->id}}" hidden>
                                        <div class="form-group">
                                            <select name="district" id="state" class="form-control" style="margin-top: 5px;" required>
                                                <option value="{{$district->id}}">{{$district->name}}</option>
                                            </select>
                                        </div>
                                        @else
                                        <div class="form-group">
                                            <select name="district" id="state" class="form-control" style="margin-top: 5px;" required>
                                            </select>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="text-right col-lg-4 col-3" style="margin-top: 20px;">
                                        Phường / Xã *
                                    </div>
                                    <div class="col-lg-8 col-7 px-0">
                                        @if (isset($ward))
                                        <input type="text" name="wardd" value="{{$ward->id}}" hidden>
                                        <div class="form-group">
                                            <select name="ward" id="city" class="form-control" style="margin-top: 5px;" required>
                                                <option value="{{$ward->id}}">{{$ward->name}}</option>
                                            </select>
                                        </div>
                                        @else
                                        <div class="form-group">
                                            <select name="ward" id="city" class="form-control" style="margin-top: 5px;" required>
                                            </select>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="text-right col-lg-4 col-3" style="margin-top: 20px;">
                                        Địa chỉ chi tiết *
                                    </div>
                                    <div class="col-lg-8 col-7 px-0">
                                        <div class="form-group">
                                            @if (isset($note))
                                            <textarea class="form-control" aria-label="With textarea" name="note" required>{{$note}}</textarea>
                                            @else
                                            <textarea class="form-control" aria-label="With textarea" name="note" required value=""></textarea>
                                            @endif 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                    @foreach ($cart as $ct)
                    @if ($ct->proInCart->promotion)
                        <p hidden>{{$sum += $ct->proInCart->promotion*$ct->quantity}}</p>
                    @else
                        <p hidden>{{$sum += $ct->proInCart->price*$ct->quantity}}</p>
                    @endif
                    @endforeach
                    @if (isset($code)&& !isset($error))
                        @if ($code->role == 0)
                        <input type="text" name="price" value="{{$sum-(($sum*$code->amount)/100)}}" hidden>
                        @elseif($code->role == 1)
                        <input type="text" name="price" value="{{$sum-$code->amount}}" hidden>
                        @endif
                    @else
                    <input type="text" name="price" value="{{$sum}}" hidden>
                    @endif
                    <br>
                    <br>
                    <div class="pb-3 row pr-4">
                        <div class="pr-0 col-3 col-lg-2" id="Step">
                            <img src="assets/img/arrow.png" class="img-fluid lazyload" alt="...">
                            <h5>Bước 2</h5>
                        </div>
                        <div class="pl-5 mt-1 col-9 col-lg-10" style="padding: 10px; background-color: #fffab4">
                            <b style="color: #f09819;">Vui lòng chọn hình thức thanh toán phù hợp với Quý Khách</b>
                        </div>
                        
                    </div>
                    <div class="col mr-4" style="background-color: #fffab4;  padding: 10px; ">
                        <b>* Lưu ý:</b> Quý khách nên thanh toán ngay để tránh sản phẩm bị tăng giá
                    </div>
                    
                    <!-- Các phương thức thanh toán hiển thị trên máy tính-->
                    @include('layouts.frontend.paymentMethod')
                    {{-- end Các phương thức thanh toán hiển thị trên máy tính --}}

                    @if (isset($code)&& !isset($error))
                    <input type="text" name="code" value="{{$code->code}}" hidden>
                    @endif
                    
                </div>
                
                {{-- side --}}
                @include('layouts.frontend.sideBill')
                {{-- end side --}}
            </div>
        </div>
    </form>
</div>
@endif
@endsection 
