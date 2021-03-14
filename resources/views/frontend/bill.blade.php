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
                    <a href="#">Chi tiết đơn hàng</a>
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
            
            <div class="py-4 pl-0 col-12 col-lg-9">
                <div class="card">
                    <div class="row py-lg-3 px-lg-3 mx-lg-3 px-2 py-2" style="border-bottom: 1px solid rgb(236, 235, 235)">
                        <div class="col-3 px-lg pr-0">
                            <a href="{{route('order.show',$bill->user_id)}}"><i class="fas fa-angle-double-left mr-1"></i>Danh sách đơn hàng</a>
                        </div>
                        <div class="text-center pl-lg pl-0 col-9 col-lg-6" id="details-order">
                            <p><b>Chi tiết đơn hàng: {{$bill->order_code}}</b></p>
                            <p><i style="color: rgb(172, 169, 169);">Ngày đặt hàng: {{date('d-m-Y H:i:s',strtotime($bill->created_at))}}</i>
                                <span>
                                    @if ($bill->status == 1)
                                    {{'Chưa duyệt'}}
                                    @endif
                                </span> 
                            </p>
                            <form action="{{route('don-hang.update', $bill->id)}}" method="post">
                                @method('patch')
                                @csrf
                                <button>
                                    <span style="color:#b9232e ;">X</span> Hủy đơn hàng</p>
                                </button>
                            </form>
                        </div>
                        <hr>
                    </div>
                    <div class="row py-2 mx-3">
                        <div class="col-lg-6 col-12 pt-2" style="background-color: #fffeee; border-right: 3px solid white;">
                            <p style="border-left: 3px solid #f09819; padding-left: 5px;"><b>Thông tin người mua</b></p>
                            <div class="row">
                                <div class="col-5 text-right" id="grey-text-infor">
                                    <p>Họ và tên:</p>
                                </div>
                                <div class="col-7 px-0">
                                    <p>{{$bill->name}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5 text-right" id="grey-text-infor">
                                    <p>Số điện thoại:</p>
                                </div>
                                <div class="col-7 px-0">
                                    <p>{{$bill->phone}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5 text-right" id="grey-text-infor">
                                    <p>Email:</p>
                                </div>
                                <div class="col-7 px-0">
                                    <p>{{$bill->userOrder->email}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5 text-right" id="grey-text-infor">
                                    <p>Địa chỉ:</p>
                                </div>
                                <div class="col-7 px-0">
                                    <p>{{$bill->address}}</p>
                                </div>
                            </div>
                        </div> 
                        
                        <div class="col-lg-6 col-12 pt-2" style="background-color: #fffeee; ">
                            <p style="border-left: 3px solid #f09819; padding-left: 5px;"><b>Thông tin thanh toán</b></p>
                            <div class="row">
                                <div class="col-5 text-right" id="grey-text-infor">
                                    <p>Phương thức thanh toán:</p>
                                </div>
                                <div class="col-7 px-0">
                                    <p>
                                        @if ($bill->form == 1)
                                        Chuyển toàn bộ tiền hàng trước
                                        @elseif($bill->form == 2)
                                        Chuyển trước 50% số tiền
                                        @elseif($bill->form == 3)
                                        Thanh toán tại chi nhánh
                                        @elseif($bill->form == 4)
                                        Thanh toán khi hàng được giao (COD)
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5 text-right" id="grey-text-infor">
                                    <p>Trạng thái:</p>
                                </div>
                                <div class="col-7 px-0">
                                    <b>
                                        @if ($bill->status == 1)
                                        Chờ duyệt
                                        @elseif($bill->status == 2)
                                        Đã duyệt
                                        @elseif($bill->status == 3)
                                        Đang giao hàng
                                        @elseif($bill->status == 4)
                                        Đã thanh toán/nhận hàng
                                        @elseif($bill->status == 5)
                                        Đã hủy
                                        @endif
                                    </b>
                                </div>
                            </div>   
                        </div>
                    </div> 
                    <div class="table-responsive d-lg-block d-none">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-center" style="background-color: #fffeee;">
                                    <th colspan="2">Thông tin sản phẩm</th>
                                    <th>Đơn giá</th>
                                    <th>Thuộc tính</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bill->orderDetail as $order)
                                <tr class="text-center">
                                    <th scope="row"><img src="{{asset('images/'.json_decode($order->productOrder->filename)[0])}}"  class="img-fluid lazyload" alt="..." width="60px" height="60px;"></th>
                                    <td width="25%" class="text-left"> 
                                        <a href="{{route('san-pham.show',$order->productOrder->slug)}}"><p>{{$order->productOrder->name}}</p></a>
                                    </td>
                                    <td>  
                                        @if ($order->productOrder->promotion)
                                        <h3 style="color:rgb(64, 64, 206) ;"> {{number_format( $order->productOrder->promotion, 0, ',', ' ' )}}.000đ </h3> 
                                        <span style="text-decoration:line-through; font-size: 12px;">{{number_format( $order->productOrder->price, 0, ',', ' ' )}}.000đ</span>
                                        @else
                                        <h3 style="color:rgb(64, 64, 206) ;"> {{number_format( $order->productOrder->price, 0, ',', ' ' )}}.000đ </h3> 
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @isset($order->size)
                                        Kích cỡ: {{$order->size}}
                                        @endisset
                                        <br>
                                        @isset($order->color)
                                        Màu sắc: {{$order->color}}
                                        @endisset
                                    </td>
                                    <td class="text-center">
                                        {{$order->quantity}} 
                                    </td>
                                    <td style="color: #f09819;">
                                        <h3>
                                            @if ($order->productOrder->promotion)
                                            {{number_format( $order->productOrder->promotion*$order->quantity, 0, ',', ' ' ).'.000đ'}}
                                            @else
                                            {{number_format( $order->productOrder->price*$order->quantity, 0, ',', ' ' ).'.000đ'}}
                                            @endif
                                        </h3>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- for Mobile -->
                    {{-- <div class="col-12 d-lg-none d-block" id="table-mobile">
                        <h4><b>Danh sách sản phẩm</b></h4>
                        <div class="col">
                            <table class="table table-striped mt-3" >
                                <thead>
                                    <tr>
                                        <th scope="col"><img src="assets/img/meat_1.png"  class="img-fluid" alt="..." width="60px" height="60px;"></th>
                                        <th scope="col"> <a href="productpage.html"><p>YAZOLE Classic Business Men Watches </p></a></th>
                                        <th class="text-center" scope="col"> <button type="button" class="btn-btn-delete"><i class="fas fa-trash-alt"></i></button></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td id="category-title">
                                          <p>Số lượng: 1</p> 
                                          <p>Kích cỡ: Vừa</p>  
                                           <p>Màu: Đỏ + trắng</p> 
                                        </td>
                                        <td style="color: #f09819;"><b>289.000đ</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div> --}}
                    <!-- End for Mobile -->

                    <div class="px-4 table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th scope="row"></th>
                                    <td style="text-align:right;"><b>Tổng giá trị</b></td>
                                    <td style="text-align: center;" id="fee">{{number_format($bill->price*1000)}} đ</td>
                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    <td style="text-align:right;">Phải thanh toán trước</td>
                                    @if ($bill->form == 2)
                                    <td style="text-align: center;" id="fee">{{number_format($bill->price*500)}} đ</td>
                                    @else
                                    <td style="text-align: center;" id="fee">0đ</td>
                                    @endif
                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    <td style="text-align:right;">Số tiền thanh toán khi nhận hàng</td>
                                    @if ($bill->form == 2)
                                    <td style="text-align: center;" id="fee">{{number_format($bill->price*500)}} đ</td>
                                    @else
                                    <td style="text-align: center;" id="fee">{{number_format($bill->price*1000)}} đ</td>
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="ml-4 mb-3" id="warning4">
                        <p><b>Lưu ý:</b></p>
                        <p><b><i>- Phí giao hàng trong nước:</i></b> Phí giao hàng từ TP.Hồ Chí Minh đến tay khách hàng</p>
                    </div>
                    <div >
                        <p class="text-center"><b>Điều khoản giao dịch trên sàn thương mại điện tử xuyên biên giới VanChuyenMy</b></p>
                        <p class="px-4">1. Trách nhiệm của Fado: Chính sách về trách nhiệm với hàng hóa thông qua các hoạt động giao dịch của Fado được thực hiện dựa trên các điều khoản của các website quốc tế và theo luật pháp Việt Nam:</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection