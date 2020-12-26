<div class="px-0 col-12 col-md-12 col-lg-4">
    <div class="px-0 mt-lg-3 mr-4 py-lg-4 py-0 mt-0 stamp" id="pink-stamp">
        <div class="cart-information py-3 px-2">
            <div class="infor-cart-details">
                <div class="text-center pt-3" >
                    <h4><b>Đơn hàng của quý khách</b></h4>
                </div>
                @foreach ($cart as $ct)
                <div class="row px-4">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th colspan="2"><a href="{{route('san-pham.show',$ct->proInCart->slug)}}">{{$ct->proInCart->name}}</a></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><a href="{{route('san-pham.show',$ct->proInCart->slug)}}"><img class="img-fluid" style="width: 45px;" src="{{asset('images/'.json_decode($ct->proInCart->filename)[0])}}" alt="Chania"></a></td>
                                <td>
                                    <div class="" id="final-price">
                                        @if ($ct->proInCart->promotion)
                                        <p id="p1">{{number_format($ct->proInCart->promotion, 0, ',', ' ' )}}.000đ</p> 
                                        <p id="p2">{{number_format($ct->proInCart->price, 0, ',', ' ' )}}.000đ</p>
                                        @else
                                        <p id="p1">{{number_format($ct->proInCart->price, 0, ',', ' ' )}}.000đ</p> 
                                        @endif      
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="">
                        <table class="table mt-3">
                            <thead>
                                <tr>
                                    <th scope="col">Hình thức giao hàng </th>
                                    <th scope="col text-right" style="color:#0080ff">Giao hàng mặc định</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    {{-- <td>Mã Sản Phẩm</td>
                                    <td class="text-right" style="color:#0080ff">B01B2HGAIA</td> --}}
                                </tr>
                                @isset($ct->color)
                                    <tr>
                                        <td>Màu sắc</td>
                                        <td class="text-right" style="color:#0080ff">
                                            {{$ct->color}}
                                        </td>
                                    </tr>
                                @endisset
                                @isset($ct->size)
                                    <tr>
                                        <td>Kích cỡ</td>
                                        <td class="text-right" style="color:#0080ff">
                                            {{$ct->size}}
                                        </td>
                                    </tr>
                                @endisset
                                <tr>
                                    <td>Số lượng</td>
                                    <td class="text-right" style="color:#0080ff">{{$ct->quantity}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                @endforeach
                <div class="row pt-2" >
                    <h5 style="margin-left: 25px;"><b>Tổng giá các trị sản phẩm:</b></h5>
                    @if (isset($code) && !isset($error))
                        @if ($code->role == 0)
                        <h5 style="color: #f09819; font-size: 18px; margin-left: 100px;">
                            <b>{{number_format(($sum-(($sum*$code->amount)/100))*1000)}} đ</b>
                        </h5>
                        @elseif($code->role == 1)
                        <h5 style="color: #f09819; font-size: 18px; margin-left: 100px;">
                            <b>{{number_format(($sum-$code->amount)*1000)}} đ</b>
                        </h5>
                        @endif
                    @else
                    <h5 style="color: #f09819; font-size: 18px; margin-left: 100px;"><b>{{$sum}}.000đ</b></h5>
                    @endif
                </div> 

                <div class="d-lg-block d-none">
                    <div class="col-12">
                        <div class="row pl-2">
                            <div class="pt-3 mt-1">
                                <b><i>Mã giảm giá</i></b>
                            </div>
                            <div id="code-discount">
                                <div class="form-group form-floating-label">
                                    @if (isset($code) && !isset($error))
                                    <input id="inputFloatingLabel1" type="text" name="voucher" class="form-control input-border-bottom" value="{{$code->code}}">
                                    <label for="inputFloatingLabel1" class="placeholder"> <i class="mr-2 fas fa-ticket-alt" style="color: #f09819;"></i><i>Sử dụng mã giảm giá</i></label>
                                    @else
                                    <input id="inputFloatingLabel1" type="text" name="voucher" class="form-control input-border-bottom" value="">
                                    <label for="inputFloatingLabel1" class="placeholder"> <i class="mr-2 fas fa-ticket-alt" style="color: #f09819;"></i><i>Sử dụng mã giảm giá</i></label>
                                    @endif
                                </div>
                            </div>
                            <div>
                                <button type="submit" name="action" value="voucher" class="mt-3 btn-gradient18" style="width: 200x;">Áp dụng</button>
                            </div>
                        </div>
                    </div>
                </div>

                @if (isset($code) && !isset($error))
                    @if ($code->role == 0)
                    <div class="col"  style="color: rgb(119, 197, 1);">
                        Giá giảm: - {{$code->amount}}%
                    </div>
                    @elseif($code->role == 1)
                    <div class="col"  style="color: rgb(119, 197, 1);">
                        Giá giảm: - {{$code->amount}}.000đ
                    </div>
                    @endif
                @endif
            </div>  
        </div>
    </div>
</div>