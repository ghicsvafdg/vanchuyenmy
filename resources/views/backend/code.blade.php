@extends('layouts.backend.app')
@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h4 class="card-title">Danh sách mã giảm giá</h4>
                </div>
                <div class="col-12">
                    <hr>
                </div>
                <div class="btn-group col-6">
                </div>
                <div style="" class="col-3">
                    <a href="{{route('manage-code.create')}}" class="btn btn-primary btn-small">
                        <span  class="btn-label">
                            <i class="fa fa-plus"></i>
                        </span>
                        Thêm mã giảm giá
                    </a>
                </div>
                <div class="col-3">
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
                <div class="row">
                    
                    <div class="col-12">
                        <form action="{{route('filter-code')}}" method="GET"> 
                            <div class="row py-3">
                                <div class="col-3 pr-0">
                                    <div class="form-group py-0">
                                        @if($role==1)
                                        <select name="role" class="form-control input-square" id="squareSelect">
                                            <option  disabled >Lọc mã theo chức năng</option>
                                            <option value="1" selected>Giảm giá theo %</option>
                                            <option value="2" >Giảm bằng tiền mặt</option>
                                            <option value="3" >Tất cả mã giảm giá</option>
                                        </select>
                                        @elseif($role==2)
                                        <select name="role" class="form-control input-square" id="squareSelect">
                                            <option  disabled >Lọc mã theo chức năng</option>
                                            <option value="1" >Giảm giá theo %</option>
                                            <option value="2" selected>Giảm bằng tiền mặt</option>
                                            <option value="3" >Tất cả mã giảm giá</option>
                                        </select>
                                        @elseif($role==3)
                                        <select name="role" class="form-control input-square" id="squareSelect">
                                            <option  disabled selected>Lọc mã theo chức năng</option>
                                            <option value="1" >Giảm giá theo %</option>
                                            <option value="2" >Giảm bằng tiền mặt</option>
                                            <option value="3" >Tất cả mã giảm giá</option>
                                        </select>
                                        @elseif($role==null||$date==null)
                                        <select name="role" class="form-control input-square" id="squareSelect">
                                            <option  disabled selected>Lọc mã theo chức năng</option>
                                            <option value="1" >Giảm giá theo %</option>
                                            <option value="2" >Giảm bằng tiền mặt</option>
                                            <option value="3" >Tất cả mã giảm giá</option>
                                        </select>
                                        @endif
                                    </div>
                                </div>
                                <div  class="col-3 pr-o">
                                    @if($date==1)
                                    <select name="date_type" class="form-control input-square" id="squareSelect">
                                        <option  disabled>Chọn phương thức lọc:</option>
                                        <option value="2">Lọc theo ngày tạo</option>
                                        <option value="1" selected>Lọc theo ngày hết hạn</option>
                                        <option value="3" >Tất cả mã giảm giá</option>
                                    </select>
                                    @elseif($date==2)
                                    <select name="date_type" class="form-control input-square" id="squareSelect">
                                        <option  disabled>Chọn phương thức lọc:</option>
                                        <option value="2" selected>Lọc theo ngày tạo</option>
                                        <option value="1" >Lọc theo ngày hết hạn</option>
                                        <option value="3" >Tất cả mã giảm giá</option>
                                        
                                    </select>
                                    @elseif($date==3||$date==null)
                                    <select name="date_type" class="form-control input-square" id="squareSelect">
                                        <option  disabled selected>Chọn phương thức lọc:</option>
                                        <option value="2" >Lọc theo ngày tạo</option>
                                        <option value="1" >Lọc theo ngày hết hạn</option>
                                        <option value="3" >Tất cả mã giảm giá</option>
                                    </select>
                                    @endif
                                </div>
                                <div class="col-2 px-0">
                                    <input id="datepicker1" name="date_from" value="{{$date_from}}" width="165" placeholder="Từ ngày..." />
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
                                    <button type="submit" class="btn btn-primary" style="width: 150x; margin-left:30px;">Tìm kiếm</button>
                                </div>
                            </div>
                        </form>
                        <hr>
                    </div>
                </div>
                <table id="basic-datatables" class="display table table-striped table-hover">
                    <!-- Example single danger button -->
                    <thead>
                        <tr>
                            <th>
                                STT
                            </th>
                            <th>Mã giảm giá</th>
                            <th>Chức năng</th>
                            <th>Đơn vị giảm</th>
                            <th>Số lượt dùng</th>
                            <th>Áp dụng đơn hàng</th>
                            <th>Ngày tạo</th>
                            <th>Ngày hết hạn</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr class="noExl">
                            <th>
                                
                            </th>
                            <th>Mã giảm giá</th>
                            <th>Chức năng</th>
                            <th>Đơn vị giảm</th>
                            <th>Số lượt dùng</th>
                            <th>Áp dụng đơn hàng</th>
                            <th>Ngày tạo</th>
                            <th>Ngày hết hạn</th>
                            <th class="noExl">Hành động</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($code as $code)
                        <tr>
                            <td>
                                {{$i++}}
                            </td>
                            <td>
                                {{$code->code}}
                            </td>
                            <td>
                                @if ($code->role == 0)
                                Giảm bằng %
                                @elseif($code->role == 1)
                                Giảm bằng tiền 
                                @endif
                            </td>
                            <td class="text-center">
                                {{$code->amount}}
                            </td>
                            <td class="text-center">
                                {{$code->use_time}}
                            </td>
                            <td class="text-center" width="10%">
                                {{number_format($code->limited*1000, 0, ',', ' ' )}}đ
                            </td>
                            <td>
                                {{date("d/m/Y",strtotime($code->created_at))}}
                            </td>
                            <td>
                                {{$code->end_time}}
                            </td>
                            <td class="noExl">
                                <div class="row">
                                    <div class="col-4">
                                        <a href="{{route('manage-code.edit', $code->id)}}" data-toggle="tooltip" data-placement="bottom" title="Sửa" class="btn btn-icon btn-secondary btn-xs"><i class="fas fa-pencil-alt"></i></a>
                                    </div>
                                    <form action="{{route('manage-code.destroy', $code->id)}}" method="post" class="test col-4">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-icon btn-danger btn-xs" data-toggle="tooltip" data-placement="bottom" title="Xóa">
                                            <i class="fas fa-trash"></i>  
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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
                filename: "Mã giảm giá"  + ".xls",
                fileext: ".xls",
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
                    title: 'Bạn có chắc muốn xóa người dùng?',
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