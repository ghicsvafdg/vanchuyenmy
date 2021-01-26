@extends('layouts.backend.app')
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Danh sách người dùng</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="row">
                    <div class="btn-group col-6">     
                        <button type="button" id="bulk" class="btn btn-primary dropdown-toggle btn-small" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" disabled>
                            Lựa chọn
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Vô hiệu hóa tài khoản</a>
                            <a class="dropdown-item" href="#">Kích hoạt tài khoản</a>
                            <a class="dropdown-item" href="#">Xóa</a>
                        </div>
                    </div>
                    <div class="col-3">
                        <a href="{{route('manage-user.create')}}" class="btn btn-primary btn-small">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                            Thêm người dùng
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
                    <div class="col-12">
                        <hr>
                    </div>
                    <div class="col-12">
                        <form action="{{route('filter-user')}}" method="GET"> 
                            <div class="row py-3">
                                <div  class="col-3 pr-o">
                                    <h3 style="margin-left:9px">Lọc theo ngày tạo</h3>
                                </div>
                                <div class="col-3 px-0">
                                    <input id="datepicker1" name="date_from" value="{{$date_from}}" width="165" placeholder="Từ ngày..." />
                                    <script>
                                        $('#datepicker1').datepicker({
                                            format: 'dd/mm/yyyy',
                                        });
                                    </script>
                                </div>
                                
                                <div class="col-3 px-0">
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
                {{-- fix here --}}
                <table id="basic-datatables" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Tên người dùng</th>
                            <th>Email</th>
                            <th>Vai trò</th>
                            <th>Trạng thái</th>
                            <th>Ngày tạo</th>
                            <th class="noExl">Hành động</th>
                        </tr>
                    </thead>
                    <tfoot>
                        {{-- fix here --}}
                        <tr class="noExl">
                            <th>Tên người dùng</th>
                            <th>Email</th>
                            <th>Vai trò</th>
                            <th>Trạng thái</th>
                            <th>Ngày tạo</th>
                            <th>Hành động</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($user as $us)
                        <tr>
                            <td>
                                {{$us->username}}
                            </td>
                            <td>
                                {{$us->email}}
                            </td>
                            <td>
                                @if ($us->role == 0)
                                admin
                                @elseif($us->role == 1)
                                user
                                @endif
                            </td>
                            <td>
                                @if ($us->status == 1)
                                    <input type="checkbox" checked disabled> 
                                @else
                                    <input type="checkbox" disabled> 
                                @endif
                            </td>
                            <td>
                                {{$us->created_at}}
                            </td>
                            {{-- fix here --}}
                            <td class="noExl">
                                <div class="row">
                                    <div class="col-4">
                                        <a href="{{route('manage-user.edit', $us->id)}}" data-toggle="tooltip" data-placement="bottom" title="Edit" class="btn btn-icon btn-secondary btn-xs"><i class="fas fa-pencil-alt"></i></a>
                                    </div>
                                    <form action="{{ route('manage-user.destroy', $us->id)}}" method="post" class="test col-4">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-icon btn-danger btn-xs" data-toggle="tooltip" data-placement="bottom" title="Delete">
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
{{-- fix here --}}
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
                filename: "Người dùng"  + ".xls",
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