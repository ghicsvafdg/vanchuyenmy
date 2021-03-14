@extends('layouts.frontend.app')
@section('content')
{{-- main --}}
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
                    <a href="#">Giỏ hàng</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
            </ul>
        </div>
        <!-- end breadcum -->
        <div class="card px-lg-4 px-2">
            <div class="card-header">
                <h4><i class="mr-2 fas fa-cart-arrow-down" style="color: #f09819;"></i><b>Giỏ hàng của quý khách</b><span style="color: rgb(185, 184, 184);"><b> [{{$cartlist}} Sản phẩm]</b></span></h4>
            </div>
            <div class="table-responsive d-lg-block d-none">
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center" style="background-color: #fffeee;">
                            <th colspan="2">Thông tin sản phẩm</th>
                            <th>Thuộc tính</th>
                            <th>Đơn giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart as $ct)
                        <tr class="text-center">
                            <th scope="row">
                                <img src="{{asset('images/'.json_decode($ct->proInCart->filename)[0])}}" class="img-fluid lazyload" alt="..." width="60px" height="60px;">
                            </th>
                            <td class="text-left" width="30%"> 
                                <a href="{{route('san-pham.show',$ct->proInCart->slug)}}"><p>{{$ct->proInCart->name}}</p></a>
                                <p>{{$ct->proInCart->product_code}}</p>
                                <hr>
                                Còn lại: {{$ct->proInCart->quantity}} sản phẩm
                            </td>
                            <td> 
                                @isset($ct->color)
                                Đã chọn màu: <b>{{$ct->color}}</b>
                                @endisset
                                <br>
                                @isset($ct->size)
                                Đã chọn size: <b>{{$ct->size}}</b>
                                @endisset
                            </td>
                            <td>  
                                @if($ct->proInCart->promotion)
                                <h3 style="color:rgb(64, 64, 206);"> {{number_format($ct->proInCart->promotion*1000, 0, ',', '.' )}}đ </h3> 
                                <span style="text-decoration:line-through; font-size: 12px;">{{number_format($ct->proInCart->price*1000, 0, ',', '.' )}}đ</span>
                                @else
                                <h3 style="color:rgb(64, 64, 206);"> {{number_format($ct->proInCart->price*1000, 0, ',', '.' )}}đ </h3>
                                @endif
                            </td>
                            <td width="10%" class="text-center">
                                {{$ct->quantity}}
                            </td>
                            <td style="color: #f09819;">
                                <h3>
                                    <span>
                                        @if ($ct->proInCart->promotion)
                                        {{number_format($ct->proInCart->promotion*$ct->quantity*1000, 0, ',', '.')}}
                                        @else
                                        {{number_format($ct->proInCart->price*$ct->quantity*1000, 0, ',', '.')}}
                                        @endif
                                    </span>đ
                                </h3>
                            </td>
                            <td id="follow" style="width:12%">
                                <form action="{{route('cart.destroy',$ct->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="my-2 btn-btn-delete">
                                        <i class="mr-1 fas fa-trash-alt"></i> Xóa
                                    </button>
                                </form>
                                <button type="button" onclick="openForm{{$ct->id}}()" class="btn-btn-delete"><i class="mr-1 fas fa-edit"></i>Chỉnh sửa</button>
                                <div class="form-popup" id="myForm{{$ct->id}}">
                                    <form action="{{route('cart.update',$ct->id)}}" class="form-container" method="POST">
                                        @method('PATCH')
                                        @csrf
                                        <h1>Thay đổi thông tin đơn hàng</h1>
                                        <div class="row">
                                            <div class="col-2">
                                                <a href="{{route('san-pham.show',$ct->proInCart->slug)}}"><img class="img-fluid" style="width: 45px;" src="{{asset('images/'.json_decode($ct->proInCart->filename)[0])}}" alt="Chania"></a>
                                            </div>
                                            <div class="col-10">
                                                <a href="{{route('san-pham.show',$ct->proInCart->slug)}}">{{$ct->proInCart->name}}</a>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group row">
                                            <div class="col-3 text-left">
                                                <b>Số lượng:</b>
                                            </div>
                                            <div class="col text-left">
                                                <input type="number" class="form-control" name="quantity" value="{{$ct->quantity}}" required min="1" max="{{$ct->proInCart->quantity}}">
                                            </div>
                                        </div>
                                          
                                        @if ($ct->proInCart->color)
                                        <div class="form-group row">
                                            <div class="col-3 text-left">
                                                <b>Màu:</b>
                                            </div>
                                            <div class="col radio-toolbar text-left">
                                                @foreach (explode(',',$ct->proInCart->color) as $color)
                                                @if ($ct->color == $color)
                                                <input type="radio" id="{{$color.$ct->id}}" name="color" value="{{$color}}" checked>
                                                <label for="{{$color.$ct->id}}">{{$color}}</label>
                                                @else 
                                                <input type="radio" id="{{$color.$ct->id}}" name="color" value="{{$color}}">
                                                <label for="{{$color.$ct->id}}">{{$color}}</label>
                                                @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        @endif

                                        @if ($ct->proInCart->size)
                                        <div class="form-group row">
                                            <div class="col-3 text-left">
                                                <b>Size:</b>
                                            </div>
                                            <div class="col radio-toolbar text-left">
                                                @foreach (explode(',',$ct->proInCart->size) as $size)
                                                @if ($ct->size == $size)
                                                <input type="radio" id="{{$size.$ct->id}}" name="size" value="{{$size}}" checked>
                                                <label for="{{$size.$ct->id}}">{{$size}}</label>
                                                @else
                                                <input type="radio" id="{{$size.$ct->id}}" name="size" value="{{$size}}">
                                                <label for="{{$size.$ct->id}}">{{$size}}</label> 
                                                @endif
                                                @endforeach 
                                            </div>
                                        </div>
                                        @endif
                                        <div class="row">
                                            <button type="submit" class="btn">Xác nhận</button>
                                            <button type="button" class="btn cancel" onclick="closeForm{{$ct->id}}()">Hủy</button>
                                        </div>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <script>
                            function openForm{{$ct->id}}() {
                                document.getElementById("myForm{{$ct->id}}").style.display = "block";
                            }
                            
                            function closeForm{{$ct->id}}() {
                                document.getElementById("myForm{{$ct->id}}").style.display = "none";
                            }
                        </script>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- for mobile --}}
            <div class="pt-2">
                <div class="col-12 px-0 d-lg-none d-block" id="table-mobile">
                    <h4><b>Danh sách sản phẩm</b></h4>
                    @foreach ($cart as $ct)
                    <div class="card py-2 px-2">
                        <div>
                            Mã sản phẩm: <b>{{$ct->proInCart->product_code}}</b>
                        </div>
                        <div class="row py-2">
                            <div class="col-2 pr-0">
                                <img src="{{asset('images/'.json_decode($ct->proInCart->filename)[0])}}" class="img-fluid lazyload" alt="..." width="60px" height="60px;">
                            </div>
                            <div class="col-6 pr-0">
                                <a href="{{route('san-pham.show',$ct->proInCart->slug)}}"><p>{{$ct->proInCart->name}}</p></a>
                            </div>
                            <div class="col-4 pl-0 text-center">
                                <button type="button" onclick="openFormMobile{{$ct->id}}()" class="btn-btn-delete"><i class="mr-1 fas fa-edit"></i>Chỉnh sửa</button>
                                <div class="form-popup-mobile" id="myFormMobile{{$ct->id}}">
                                    <form action="{{route('cart.update',$ct->id)}}" method="POST">
                                        @method('PATCH')
                                        @csrf
                                        <div class="text-center"><h2>Thay đổi thông tin đơn hàng</h2></div>
                                        <div class="row">
                                            <div class="col-4">
                                                <a href="{{route('san-pham.show',$ct->proInCart->slug)}}">
                                                    <img class="img-fluid lazyload" style="width: 55px;" src="{{asset('images/'.json_decode($ct->proInCart->filename)[0])}}" alt="Chania">
                                                </a>
                                            </div>
                                            <div class="col-8">
                                                <a href="{{route('san-pham.show',$ct->proInCart->slug)}}">{{$ct->proInCart->name}}</a></th>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group row">
                                            <div class="col-4 text-left">
                                                <b>Số lượng:</b>
                                            </div>
                                            <div class="col text-left">
                                                <input type="number" class="form-control" name="quantity" value="{{$ct->quantity}}" required min="1" max="{{$ct->proInCart->quantity}}">
                                            </div>
                                        </div>
                                          
                                        @if ($ct->proInCart->color)
                                        <div class="form-group row">
                                            <div class="col-4 text-left">
                                                <b>Màu:</b>
                                            </div>
                                            <div class="col radio-toolbar text-left">
                                                @foreach (explode(',',$ct->proInCart->color) as $color)
                                                @if ($ct->color == $color)
                                                <input type="radio" id="{{$color.$ct->id}}Mobile" name="color" value="{{$color}}" checked>
                                                <label for="{{$color.$ct->id}}Mobile">{{$color}}</label>
                                                @else 
                                                <input type="radio" id="{{$color.$ct->id}}Mobile" name="color" value="{{$color}}">
                                                <label for="{{$color.$ct->id}}Mobile">{{$color}}</label>
                                                @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        @endif

                                        @if ($ct->proInCart->size)
                                        <div class="form-group row">
                                            <div class="col-4 text-left">
                                                <b>Size:</b>
                                            </div>
                                            <div class="col radio-toolbar text-left">
                                                @foreach (explode(',',$ct->proInCart->size) as $size)
                                                @if ($ct->size == $size)
                                                <input type="radio" id="{{$size.$ct->id}}Mobile" name="size" value="{{$size}}" checked>
                                                <label for="{{$size.$ct->id}}Mobile">{{$size}}</label>
                                                @else
                                                <input type="radio" id="{{$size.$ct->id}}Mobile" name="size" value="{{$size}}">
                                                <label for="{{$size.$ct->id}}Mobile">{{$size}}</label> 
                                                @endif
                                                @endforeach 
                                            </div>
                                        </div>
                                        @endif
                                        <div class="row">
                                            <button type="submit" class="btn-confirm">Xác nhận</button>
                                            <button type="button" class="btn-cancel" onclick="closeFormMobile{{$ct->id}}()">Hủy</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="py-2">
                                    <form action="{{route('cart.destroy',$ct->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="my-2 btn-btn-delete">
                                            <i class="mr-1 fas fa-trash-alt"></i> Xóa
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col" id="category-title">
                                <p>Số lượng: {{$ct->quantity}}</p>
                                @isset($ct->color)
                                Đã chọn màu: <b>{{$ct->color}}</b>
                                @endisset
                                <br>
                                @isset($ct->size)
                                Đã chọn size: <b>{{$ct->size}}</b>
                                @endisset
                            </div>
                            
                            <div class="col-4 pt-3 text-right">
                                @if($ct->proInCart->promotion)
                                <h3 style="color:rgb(64, 64, 206);"> {{number_format($ct->proInCart->promotion*1000, 0, ',', '.' )}}đ </h3> 
                                <span style="text-decoration:line-through; font-size: 12px;">{{number_format($ct->proInCart->price*1000, 0, ',', '.' )}}đ</span>
                                @else
                                <h3 style="color:rgb(64, 64, 206);"> {{number_format($ct->proInCart->price*1000, 0, ',', '.' )}}đ </h3>
                                @endif
                            </div>
                        </div>
                    </div>
                    <script>
                        function openFormMobile{{$ct->id}}() {
                            document.getElementById("myFormMobile{{$ct->id}}").style.display = "block";
                        }
                        
                        function closeFormMobile{{$ct->id}}() {
                            document.getElementById("myFormMobile{{$ct->id}}").style.display = "none";
                        }
                    </script>
                    @endforeach
                </div>
            </div>
            {{-- end for mobile --}}
            <div class="text-right" id="warning5">
                <p>Miễn phí giao hàng trong nước cho đơn hàng từ 1,000,000 đ</p>
            </div>
            <div class="text-right py-4">
                <b>Tổng tiền: </b>
                <span style="color: #f09819; font-size: 20px;">
                    <b>
                        @foreach ($cart as $ct)
                        @if ($ct->proInCart->promotion)
                            <p hidden>{{$sum += $ct->proInCart->promotion*$ct->quantity}}</p>
                        @else
                            <p hidden>{{$sum += $ct->proInCart->price*$ct->quantity}}</p>
                        @endif
                        @endforeach
                        {{number_format($sum*1000, 0, ',', '.')}}
                    </b>
                </span>
                <b style="color: #f09819; font-size: 20px;">đ</b>
            </div>
            <div class="pb-3 text-right">
                <a href="{{route('index')}}" class="btn-gradient16" style="width: 500x; margin-left:60px;">
                    Tiếp tục mua hàng
                </a>
                <a href="{{url('thanh-toan')}}" class="btn-gradient19" style="width: 500x; margin-left:60px;">
                    Tiến hành đặt hàng <i class="fas fa-angle-double-right"></i>
                </a>
            </div>
            <div class="text-right">
                <p><i>* Quý khách nên thanh toán ngay để tránh sản phẩm bị tăng giá  ?? :D ??</i></p>
            </div>
        </div>
    </div>
</div>
{{-- end main --}}
@endsection