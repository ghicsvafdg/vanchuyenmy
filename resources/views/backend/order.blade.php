@extends('layouts.backend.app')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-6">
                <h4 class="card-title">Danh sách đơn hàng</h4>
            </div>
            <div class="col-12">
                <hr>
            </div>
            <div class="col-3">
                
            </div>
            <div class="btn-group col-6">     
                
            </div>
            <div class="col-3">
                
            </div>

            <div class="col-10">
                
            </div>
            <div class="col-2">
                <button id="exporttable" class="btn btn-primary">
                    <span class="btn-label">
                        <i class="fas fa-file-excel"></i>
                    </span>
                    Xuất file excel
                </button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            {{-- filter --}}
            <form action="{{route('filter-orders')}}" method="GET"> 
                <div class="row py-3">
                    <div class="col-3 pr-0">
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
                            @elseif($status==3)
                            <select name="status" class="form-control input-square" id="squareSelect">
                                <option  disabled >Trạng thái đơn hàng</option>
                                <option value="1" >Chờ kiểm duyệt</option>
                                <option value="2" >Đã kiểm duyệt</option>
                                <option value="3" selected>Đang giao hàng</option>
                                <option value="4">Hàng đã giao</option>
                                <option value="5">Đã hủy</option>
                            </select>
                            @elseif($status==4)
                            <select name="status" class="form-control input-square" id="squareSelect">
                                <option  disabled >Trạng thái đơn hàng</option>
                                <option value="1" >Chờ kiểm duyệt</option>
                                <option value="2" >Đã kiểm duyệt</option>
                                <option value="3" >Đang giao hàng</option>
                                <option value="4" selected>Hàng đã giao</option>
                                <option value="5">Đã hủy</option>
                            </select>
                            @elseif($status==5)
                            <select name="status" class="form-control input-square" id="squareSelect">
                                <option  disabled >Trạng thái đơn hàng</option>
                                <option value="1" >Chờ kiểm duyệt</option>
                                <option value="2" >Đã kiểm duyệt</option>
                                <option value="3" >Đang giao hàng</option>
                                <option value="4" >Hàng đã giao</option>
                                <option value="5" selected>Đã hủy</option>
                            </select>
                            @elseif($status==null)
                            <select name="status" class="form-control input-square" id="squareSelect">
                                <option  disabled selected>Trạng thái đơn hàng</option>
                                <option value="1" >Chờ kiểm duyệt</option>
                                <option value="2" >Đã kiểm duyệt</option>
                                <option value="3" >Đang giao hàng</option>
                                <option value="4" >Hàng đã giao</option>
                                <option value="5" >Đã hủy</option>
                            </select>
                            @endif
                        </div>
                    </div>
                    <div class="col-3 pr-o">
                        <h3 style="margin-top:5px; margin-left:2px" >Lọc đơn hàng theo ngày:</h3>
                    </div>
                    <div class="col-2 px-0">
                        <input id="datepicker1" value="{{$date_from}}" name="date_from"  width="165" placeholder="Từ ngày..." />
                        
                        <script>
                            $('#datepicker1').datepicker({
                                format: 'dd/mm/yyyy',
                            });
                        </script>
                    </div>
                    
                    <div class="col-2 px-0">
                        <input id="datepicker2" name="date_to" value="{{$date_to}}" width="165" placeholder="Đến ngày..."  />
                        
                        <script>
                            $('#datepicker2').datepicker({
                                format: 'dd/mm/yyyy',
                            });
                        </script>
                    </div>
                    
                    <div class="col-2">
                        <button type="submit" class="btn btn-primary" style="width: 200x; margin-left:60px;">Tìm kiếm</button>
                    </div>
                </div>
            </form>
            {{-- end filter --}}
            
            <hr>
            <table id="basic-datatables" class="display table table-striped table-hover" style="width:100%">
                <!-- Example single danger button -->
                <thead>
                    <tr>
                        <th>
                            STT
                        </th>
                        <th>Mã đơn hàng</th>
                        <th>Số loại</th>
                        <th>Mã giảm</th>
                        <th>Tổng tiền</th>
                        <th>Người đặt</th>
                        <th>Ngày đặt</th>
                        <th>Hình thức giao hàng</th>
                        <th>Trạng thái</th>
                        <th class="noExl">Thao tác</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr class="noExl">
                        <th>
                            STT
                        </th>
                        <th>Mã đơn hàng</th>
                        <th>Số loại</th>
                        <th>Mã giảm</th>
                        <th>Tổng tiền</th>
                        <th>Người đặt</th>
                        <th>Ngày đặt</th>
                        <th>Hình thức giao hàng</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($order as $ord)
                    <tr>
                        <td>{{$i = $i +1}}</td>
                        <td width="10%">  
                            <a href="{{route('manage-order.show',$ord->id)}}">{{$ord->order_code}}</a>
                        </td>
                        <td class="text-center">
                            <span data-toggle="tooltip" title="giảm">{{$ord->orderDetail->count()}}</span>
                        </td>
                        <td class="text-center">
                            {{$ord->voucher}}
                        </td>
                        <td width="10%">
                            {{number_format($ord->price*1000, 0, ',', ' ' )}}đ
                        </td>
                        <td>
                            {{$ord->userOrder->username}}
                        </td>
                        <td width="10%">
                            {{date("d/m/Y",strtotime($ord->created_at))}}
                        </td>
                        <td>
                            @if ($ord->form == 1)
                            Chuyển toàn bộ tiền hàng trước
                            @elseif($ord->form == 2)
                            Chuyển trước 50% số tiền
                            @elseif($ord->form == 3)
                            Thanh toán tại chi nhánh
                            @elseif($ord->form == 4)
                            Thanh toán khi hàng được giao (COD)
                            @endif
                        </td>
                        <td>
                            @if ($ord->status == 1)
                            Chờ duyệt
                            @elseif($ord->status == 2)
                            Đã duyệt
                            @elseif($ord->status == 3)
                            Đang giao hàng
                            @elseif($ord->status == 4)
                            Đã thanh toán/nhận hàng
                            @elseif($ord->status == 5)
                            Đã hủy
                            @endif
                        </td>
                        <td class="mt-2 navbar-nav text-center">
                            <li class="nav-item dropdown hidden-caret noExl">
                                <a class="dropdown-toggle profile-pic mt-1" data-toggle="dropdown" href="#" aria-expanded="false">
                                    Thao tác
                                </a>
                                <ul class="dropdown-menu dropdown-user animated fadeIn" style="width:10%">
                                    <li>
                                        <div>
                                            <a class="dropdown-item btn-secondary text-center btn-link" href="{{route('manage-order.edit', $ord->id)}}" data-toggle="tooltip" data-placement="bottom" title="Chỉnh sửa">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                        </div>
                                        <div>
                                            <form action="{{ route('manage-order.destroy', $ord->id)}}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="dropdown-item btn-danger text-center btn-link" data-toggle="tooltip" data-placement="bottom" title="Xóa">
                                                    <i class="fas fa-trash"></i>  
                                                </button>
                                            </form>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
@section('script')
<script>
    $(function() {
        $("#exporttable").click(function(e){
            var table = $("#basic-datatables");
            if(table && table.length){
                $(table).table2excel({
                    // cái nào không muốn hiện thêm class noExl vào
                    exclude: ".noExl",
                    name: "Excel Document Name",
                    // đổi tên chỗ này
                    filename: "Đơn hàng" + ".xls",
                    fileext: ".xlsx",
                    exclude_img: true,
                    exclude_links: true,
                    exclude_inputs: true,
                    preserveColors: false
                });
            }
        });
    });
</script>

<script>
    //== Class definition
    var SweetAlert2Demo = function() {
        //== Demos
        var initDemos = function() {
            $('.btn-danger').click(function(e) {
                var $form =  $(this).closest("form");
                e.preventDefault();
                swal({
                    title: 'Bạn có chắc muốn đơn hàng này?',
                    text: "Một khi đã xóa sẽ không thể khôi phục!",
                    type: 'warning',
                    buttons:{
                        confirm: {
                            text : 'Có, Xóa đi!',
                            className : 'btn btn-success'
                        },
                        cancel: {
                            visible: true,
                            text: 'Hủy',
                            className: 'btn btn-danger'
                        }
                    }
                }).then((Delete) => {
                    
                    if (Delete) {
                        if (Delete) {
                            $form.submit();
                        }
                        swal({
                            title: user_id,
                            text: 'Your file has been deleted.',
                            type: 'success',
                            buttons : {
                                confirm: {
                                    className : 'btn btn-success'
                                }
                            }
                        });
                    } else {
                        swal.close();
                    }
                });
            });
        };
        return {
            //== Init
            init: function() {
                initDemos();
            },
        };
    }();
    
    //== Class Initialization
    jQuery(document).ready(function() {
        SweetAlert2Demo.init();
    });
</script>
@endsection