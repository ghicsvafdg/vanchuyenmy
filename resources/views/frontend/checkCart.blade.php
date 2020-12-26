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
                    <a href="#">Kiểm tra đơn hàng</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                
            </ul>
        </div>
        <!-- end breadcum -->
        <h2 class="pt-4 mx-3"><b>Kiểm tra đơn hàng</b></h2>
        <div class="row py-3 mx-3" id="stamp-check-cart">
            <div class="col-lg-4 col-12 pl-0">
                <div class="card px-2 py-3">
                    <div class="box-check-cart">
                        <div class="text-center">
                            <h5><i class="mr-1 pb-2 fas fa-search"></i><b>Kiểm tra đơn hàng của bạn</b></h5>
                        </div>
                        <p class="pl-2">Phương thức kiểm tra</p>
                        <form action="{{route('list-cart')}}" method="get">
                            <div class="form-check">
                                <label class="form-radio-label">
                                    <input class="form-radio-input" type="radio" name="option1" value="0" @if(isset($option) && $options == 0) checked @endif required>
                                    <span class="form-radio-sign">Số điện thoại</span>
                                </label>
                                <label class="form-radio-label ml-3">
                                    <input class="form-radio-input" type="radio" name="option1" value="1" @if(isset($option) && $options == 1) checked @endif>
                                    <span class="form-radio-sign">Email</span>
                                </label>
                            </div>
                            
                            <div class="form-group">  
                                <label for="email2">Số điện thoại/Email</label>
                                <input type="text"  name="data" class="form-control @error('data') is-invalid @enderror" required value="@isset($option) {{$option}} @endisset" >
                                @error('data')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}: {{ old('data') }}</strong>
                                </span>
                                @enderror
                            </div>
                            <p class="pl-2">
                                Nếu quý khách có bất kỳ thắc mắc nào, xin vui lòng gọi 0888.227.837
                            </p>
                            <div class="text-right pb-3 pr-5">
                                <button type="submit" class="btn-gradient18" style="width: 200x; ">Xem ngay</button> 
                            </div>
                        </form>
                    </div>
                </div>
            </div> 
            
            {{-- hiện thị thông tin đơn hàng --}}
            <div class="col-lg-8 col-12 pt-2" style="background-color: white;  border-right: 3px solid white;">
            @foreach ($order as $order)
            <div class="row">
                <div class="col-6">
                    <p style="border-left: 3px solid #f09819; padding-left: 5px;"><b>Mã đơn hàng:</b> {{$order->order_code}}</p>
                    <div class="row">
                        <div class="col-5 text-right" id="grey-text-infor">
                            <p>Họ và tên:</p>
                        </div>
                        <div class="col-7 px-0">
                            <p>{{$order->name}}</p>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-5 text-right" id="grey-text-infor">
                            <p>Số điện thoại:</p>
                        </div>
                        <div class="col-7 px-0">
                            <p>{{$order->phone}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5 text-right" id="grey-text-infor">
                            <p>Email:</p>
                        </div>
                        <div class="col-7 px-0">
                            <p>{{$order->userOrder->email}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5 text-right" id="grey-text-infor">
                            <p>Địa chỉ:</p>
                        </div>
                        <div class="col-7 px-0">
                            <p>{{$order->address}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5 text-right" id="grey-text-infor">
                            <p>Trạng thái:</p>
                        </div>
                        <div class="col-7 px-0">
                            @if($order->status==1)
                            <p><span style="color: #b9232e;">Chờ duyệt</span> / <i>Hướng dẫn</i></p>
                            @elseif($order->status==2)
                            <p><span style="color: #b9232e;">Đã duyệt</span> / <i>Hướng dẫn</i></p>
                            @elseif($order->status==3)
                            <p><span style="color: #b9232e;">Đang giao hàng</span> / <i>Hướng dẫn</i></p>
                            @elseif($order->status==4)
                            <p><span style="color: #b9232e;">Đã thanh toán/nhận hàng</span> / <i>Hướng dẫn</i></p>
                            @elseif($order->status==5)
                            <p><span style="color: #b9232e;">Đã hủy</span> / <i>Hướng dẫn</i></p>
                            @endif
                        </div>
                    </div> 
                </div>
                <div class="col-6">
                    @foreach($order->orderDetail as $detail)
                    <div class="row px-2 px-lg-4">
                        <table class="table table-striped mb-4">
                            <thead>
                                <tr>
                                    <th colspan="2"> <a href="{{route('san-pham.show',$detail->productOrder->slug)}}">{{$detail->productOrder->name}}</a></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style=""><img class="img-fluid" style="width: 45px;" src="{{asset('images/'.json_decode($detail->productOrder->filename)[0])}}" alt="Chania"></td>
                                    <td>
                                        <div class="" id="final-price">
                                            <p id="p1">{{number_format( $detail->productOrder->promotion, 0, ',', ' ' )}}.000 đ</p> 
                                            <p id="p2">{{number_format( $detail->productOrder->price, 0, ',', ' ' )}}.000 đ</p> 
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    @endforeach
                </div>
            </div>
            <hr>
            @endforeach
            </div>
        </div> 
    </div>
</div>
@endsection