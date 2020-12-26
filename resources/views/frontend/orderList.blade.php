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
                    <a href="#">Lịch sử đơn hàng</a>
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
            <!-- end left category -->
            
            <div class="card col-lg-9 col-12 mt-4" style="height: 72%">
                <div class="row no-gutters">
                    <div class="px-2 pt-3 col-md-12">
                        <h3 style="border-left: 3px solid #f09819; padding-left:5px;"><b>Lịch sử đơn hàng </b></h3>
                        <hr width=100%>
                    </div>
                    <div class="col-12">
                        <div class="private-information">
                            {{-- filter --}}
                            <form action="{{route('filter-order')}}" method="GET"> 
                                <div class="row py-2">
                                    <div class="col-lg-4 col-12 pr-0 pb-2 pb-lg">
                                        <div class="form-group py-0">
                                            @if($status==1)
                                            <select name="status" class="form-control input-square" id="squareSelect">
                                                <option  disabled >Trạng thái đơn hàng</option>
                                                <option value="1" selected>Chờ kiểm duyệt</option>
                                                <option value="2">Đã kiểm duyệt</option>
                                                <option value="3">Đang giao hàng</option>
                                                <option value="4">Hàng đã giao</option>
                                                <option value="5">Đã hủy</option>
                                            </select>
                                            @elseif($status==2)
                                            <select name="status" class="form-control input-square" id="squareSelect">
                                                <option  disabled >Trạng thái đơn hàng</option>
                                                <option value="1" >Chờ kiểm duyệt</option>
                                                <option value="2" selected>Đã kiểm duyệt</option>
                                                <option value="3">Đang giao hàng</option>
                                                <option value="4">Hàng đã giao</option>
                                                <option value="5">Đã hủy</option>
                                            </select>
                                            @elseif($status ==3)
                                            <select name="status" class="form-control input-square" id="squareSelect">
                                                <option  disabled >Trạng thái đơn hàng</option>
                                                <option value="1" >Chờ kiểm duyệt</option>
                                                <option value="2" >Đã kiểm duyệt</option>
                                                <option value="3"selected>Đang giao hàng</option>
                                                <option value="4">Hàng đã giao</option>
                                                <option value="5">Đã hủy</option>
                                            </select>
                                            @elseif($status ==4)
                                            <select name="status" class="form-control input-square" id="squareSelect">
                                                <option  disabled >Trạng thái đơn hàng</option>
                                                <option value="1" >Chờ kiểm duyệt</option>
                                                <option value="2" >Đã kiểm duyệt</option>
                                                <option value="3">Đang giao hàng</option>
                                                <option value="4" selected>Hàng đã giao</option>
                                                <option value="5">Đã hủy</option>
                                            </select>
                                            @elseif($status ==5)
                                            <select name="status" class="form-control input-square" id="squareSelect">
                                                <option  disabled >Trạng thái đơn hàng</option>
                                                <option value="1" >Chờ kiểm duyệt</option>
                                                <option value="2" >Đã kiểm duyệt</option>
                                                <option value="3">Đang giao hàng</option>
                                                <option value="4">Hàng đã giao</option>
                                                <option value="5"selected>Đã hủy</option>
                                            </select>
                                            @else
                                            <select name="status" class="form-control input-square" id="squareSelect">
                                                <option  disabled selected>Trạng thái đơn hàng</option>
                                                <option value="1" >Chờ kiểm duyệt</option>
                                                <option value="2" >Đã kiểm duyệt</option>
                                                <option value="3">Đang giao hàng</option>
                                                <option value="4">Hàng đã giao</option>
                                                <option value="5">Đã hủy</option>
                                            </select>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-3 col-6 px-0 pl-4 pb-lg">
                                        <input id="datepicker1" name="date_from" value="@isset($date_from){{$date_from}}@endisset" width="100" placeholder="Từ ngày..." />
                                        <script>
                                            $('#datepicker1').datepicker({
                                                format: 'dd/mm/yyyy',
                                            });
                                        </script>
                                    </div>

                                    <div class="col-lg-3 col-6 px-0">
                                        <input id="datepicker2" name="date_to" value="@isset($date_to){{$date_to}}@endisset" width="100" placeholder="Đến ngày..."  />
                                        <script>
                                            $('#datepicker2').datepicker({
                                                format: 'dd/mm/yyyy',
                                            });
                                        </script>
                                    </div>
                                    
                                    <div class="col-lg-2 mt-lg-0 mt-2">
                                        <button type="submit" class="btn-gradient17" style="width: 200x; margin-left:60px;">Tìm kiếm</button>
                                    </div>
                                </div>
                            </form>
                            {{-- end filter --}}

                            {{-- show data in computer view --}}
                            <div>
                                <div class="table-responsive d-lg-block d-none">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col"><b>Mã đơn hàng</b></th>
                                                <th scope="col"><b>Số loại sản phẩm</b></th>
                                                <th scope="col"><b>Tổng tiền đơn hàng</b></th>
                                                <th scope="col">Trạng thái</th>
                                                <th scope="col">Ngày tạo</th>
                                                <th scope="col">Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order as $od)
                                            <tr>
                                                <th scope="row" id="number-code"><a href="{{route('don-hang.show',$od->id)}}">{{$od->order_code}}</a></th>
                                                <td class="text-center">{{App\Models\OrderDetail::where('orders_id',$od->id)->count()}}</td>
                                                <td id="total-cost" class="text-center">{{number_format($od->price*1000, 0, ',', ' ' )}}đ</td>
                                                <td>
                                                    @if ($od->status == 1)
                                                    {{'Chờ duyệt'}}
                                                    @elseif($od->status == 2)
                                                    {{'Đã duyệt'}}
                                                    @elseif($od->status == 3)
                                                    {{'Đang giao hàng'}}
                                                    @elseif($od->status == 4)
                                                    {{'Đã thanh toán/nhận hàng'}}
                                                    @elseif($od->status == 5)
                                                    {{'Đã hủy'}}
                                                    @endif
                                                </td>
                                                <td id="date">
                                                    <p>{{date("d-m-Y H:i:s",strtotime($od->created_at))}}</p>
                                                </td>
                                                <td>
                                                    <form action="{{ route('don-hang.destroy', $od->id)}}" method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="dropdown-item btn-danger text-center btn-link" data-toggle="tooltip" data-placement="bottom" title="Xóa đơn hàng">
                                                            <i class="fas fa-trash"></i>  
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{-- show data in computer view --}}
                        </div>
                    </div>
                    <!-- for Mobile -->
                    <div class="col-12 d-lg-none d-block" >
                        @foreach ($order as $od)
                        <div class="card py-3 px-2">
                            <div class="row pb-2 mx-1" style="border-bottom: 1px solid rgb(230, 230, 230);">
                                <div class="col-6 text-left">
                                    <b>Mã đơn hàng</b>
                                </div>
                                <div class="col-6 text-right">
                                    @if ($od->status == 1)
                                    {{'Chờ duyệt'}}
                                    @elseif($od->status == 2)
                                    {{'Đã duyệt'}}
                                    @elseif($od->status == 3)
                                    {{'Đang giao hàng'}}
                                    @elseif($od->status == 4)
                                    {{'Đã thanh toán/nhận hàng'}}
                                    @elseif($od->status == 5)
                                    {{'Đã hủy'}}
                                    @endif
                                </div>
                            </div>
                            <div class="row py-2 mx-1" style="border-bottom: 1px solid rgb(230, 230, 230);">
                                <div class="col-6 text-left">
                                    <a href="{{route('don-hang.show',$od->id)}}">{{$od->order_code}}</a>
                                </div>
                                <div class="col-6 text-right" id="category-title">
                                    <p>{{date("d-m-Y H:i:s",strtotime($od->created_at))}}</p>
                                </div>
                            </div>
                            <div class="row py-2 mx-1" style="border-bottom: 1px solid rgb(230, 230, 230);">
                                <div class="col-6 text-left">
                                    Tổng tiền đơn hàng
                                </div>
                                <div class="col-6 text-right" id="category-title">
                                    <p style="color: #f09819;"><b>{{number_format($od->price*1000, 0, ',', ' ' )}}đ</b></p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- End for Mobile -->
                </div>
            </div>    
        </div>
    </div>
    
    @endsection