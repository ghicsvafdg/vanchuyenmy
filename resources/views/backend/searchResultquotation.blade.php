@extends('layouts.backend.app')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-6">
                <h4 class="card-title">Danh sách yêu cầu báo giá</h4>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            {{-- filter --}}
            <form action="{{route('qfilter')}}" method="GET">
                <div class="private-information">
                    <div class="row py-3">
                        <div class="row">
                            <div class="col pr-0 text-right">
                                <p class="mt-2">Ngày tạo đơn: </p>
                            </div>
                            <div class="col pr-0">
                                <input id="datepicker1" name="date_from" value="{{old('date_from')}}" placeholder="từ" readonly/>
                                <script>
                                    $('#datepicker1').datepicker({
                                        format: 'dd/mm/yyyy',
                                    });
                                </script>
                            </div>
                            <div class="col">
                                <input id="datepicker2" name="date_to" value="{{old('date_to')}}" placeholder="đến" readonly/>
                                <script>
                                    $('#datepicker2').datepicker({
                                        format: 'dd/mm/yyyy',
                                    });
                                </script>
                            </div>
                        </div>
                        <div class="col-2 pl-4">
                            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                        </div>
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
                        <th>link sản phẩm</th>
                        <th>Người yêu cầu</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Ngày gửi yêu cầu</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>
                            STT
                        </th>
                        <th>link sản phẩm</th>
                        <th>Người yêu cầu</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Ngày gửi yêu cầu</th>
                        <th>Thao tác</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($quotation as $quo)
                    <tr>
                        <td class="text-center" width="5%">{{$i = $i +1}}</td>
                        <td width="40%">  
                            <a href="{{$quo->link_product}}" target="_blank" rel="noopener noreferrer">{{$quo->link_product}}</a>
                        </td>
                        <td class="text-center" width="15%">
                            {{$quo->username}}
                        </td>
                        <td width="10%">
                            {{$quo->phone}}
                        </td>
                        <td width="10%">
                            {{$quo->email}}
                        </td>
                        <td width="10%">
                            {{date("d-m-Y H:i:s",strtotime($quo->created_at))}}
                        </td>
                        <td class="mt-2 navbar-nav text-center">
                            <li class="nav-item dropdown hidden-caret">
                                <a class="dropdown-toggle profile-pic mt-1" data-toggle="dropdown" href="#" aria-expanded="false">
                                    Thao tác
                                </a>
                                <ul class="dropdown-menu dropdown-user animated fadeIn" style="width:10%">
                                    <li>
                                        <div>
                                            <a class="dropdown-item btn-primary text-center btn-link" href="{{route('manage-quotation.show', $quo->id)}}" data-toggle="tooltip" data-placement="bottom" title="Xem">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                        <div>
                                            <a class="dropdown-item btn-secondary text-center btn-link" href="{{route('manage-quotation.edit', $quo->id)}}" data-toggle="tooltip" data-placement="bottom" title="Báo giá">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                        </div>
                                        <div>
                                            <form action="{{ route('manage-quotation.destroy', $quo->id)}}" method="post">
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
    //== Class definition
    var SweetAlert2Demo = function() {
        //== Demos
        var initDemos = function() {
            $('.btn-danger').click(function(e) {
                var $form =  $(this).closest("form");
                e.preventDefault();
                swal({
                    title: 'Bạn có chắc muốn hủy bản yêu cầu báo giá này?',
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