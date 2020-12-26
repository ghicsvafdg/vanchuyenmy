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
                        {{-- filter  --}}
                        <form action="{{route('filter-promotion')}}" method="GET"> 
                            <div class="row">
                                <div class="col">
                                    <select name="option" class="form-control">
                                        <option value="1" selected>Người dùng đã mua hàng</option>
                                        <option value="2">Người dùng chưa mua hàng</option>
                                        <option value="3">Toàn bộ người dùng</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="username" placeholder="Điền tên hoặc email người dùng">
                                </div>
                                <div class="col-2">
                                    <button type="submit" class="btn btn-primary" style="width: 150x; margin-left:30px;">Tìm kiếm</button>
                                </div>
                            </div>
                        </form>
                        {{-- end filter --}}
                        <br>

                        <form action="{{route('manage-promotion.create')}}" method="get">
                            <div class="btn-group col-6"> 
                                <button type="submit" id="bulk" class="btn btn-primary btn-small" disabled>
                                    Gửi email
                                </button>
                            </div>
                            <hr>
                    </div>
                    <table id="myTable" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center"><input type="checkbox" name="false" onClick="toggle(this)" class="checkall"/><br/></th>
                                <th>Tên người dùng</th>
                                <th>Email</th>
                                <th>Số đơn hàng</th>
                                <th>Tổng tiền đã tiêu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $us)
                            <tr class="item">
                                <td class="text-center">
                                    <input type="checkbox" name="getEmail[]" value="{{$us->email}}" class="checkbox">
                                </td>
                                <td>
                                    {{$us->username}}
                                </td>
                                <td>
                                    {{$us->email}}
                                </td>
                                <td>
                                    {{App\Models\Order::where('user_id',$us->id)->count()}}
                                </td>
                                <td>
                                    {{number_format(App\Models\Order::where('user_id',$us->id)->sum('price')*1000, 0, '.', ',' )}} VNĐ
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    function toggle(source) {
        checkboxes = document.getElementsByName('getEmail[]');
        bn = document.getElementById('bulk');
        for(var i=0, n=checkboxes.length;i<n;i++) {
            checkboxes[i].checked = source.checked;
            if(checkboxes[i].checked = source.checked){
                bn.disabled = false;
            }else{
                bn.disabled = true;
            }
        }
    }
    $(function() {
        $(".checkbox").click(function(){
            $('#bulk').prop('disabled',$('input.checkbox:checked').length == 0);
        });
    });
</script>
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
@endsection