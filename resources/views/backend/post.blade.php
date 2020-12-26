@extends('layouts.backend.app')
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Danh sách bài viết thương mại</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="row">
                    <div class="col-6">
                        <a href="{{route('manage-post.create')}}" class="btn btn-primary">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                            Thêm bài viết
                        </a>
                    </div>
                    <div class="col-12">
                        <form action="{{route('filter-post')}}" method="GET"> 
                            <div class="row py-3">
                                <div class="col-3 pr-0">
                                    <div class="form-group py-0">
                                        <select name="category" class="form-control input-square" id="squareSelect">
                                            <option  disabled selected>Bài viết theo danh mục</option>
                                            @foreach($categories as $cate)
                                            <option value="{{$cate->id}}">{{$cate->title}}</option>
                                            {{-- @if(count($cate->childs))
                                            <option value="{{$childs->id}}">{{$childs->title}}
                                            @endif --}}
                                            {{-- <option value="2">Giảm bằng tiền mặt</option> --}}
                                            @endforeach
                                            {{-- <option value="2">Đơn vị giảm</option>
                                            <option value="3">Số lượt dùng</option> --}}
                                        </select>
                                    </div>
                                </div>
                                <div style="margin-top:5px" class="col-2 pr-o">
                                    <h3>Ngày đăng:</h3>
                                </div>
                                <div class="col-2 px-0">
                                    <input id="datepicker1" value="{{$date_from}}" name="date_from" readonly width="165" placeholder="Từ ngày..." />
                                    
                                    <script>
                                        $('#datepicker1').datepicker({
                                            format: 'dd/mm/yyyy',
                                        });
                                    </script>
                                </div>
                                
                                <div class="col-2 px-0">
                                    <input id="datepicker2" value="{{$date_to}}" name="date_to"  width="165" placeholder="Đến ngày..."  />
                                    
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
                        <hr>
                    </div>
                </div>
                <table id="basic-datatables" class="display table table-striped table-hover">
                    <!-- Example single danger button -->
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên bài viết</th>
                            <th>Ảnh</th>
                            <th>Tác giả</th>
                            <th>Danh mục</th>
                            <th>Trạng thái</th>
                            <th>Ngày đăng</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>STT</th>
                            <th>Tên bài viết</th>
                            <th>Ảnh</th>
                            <th>Tác giả</th>
                            <th>Danh mục</th>
                            <th>Trạng thái</th>
                            <th>Ngày đăng</th>
                            <th>Hành động</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($post as $ps)
                        <tr>
                            <td>
                                {{$i++}}
                            </td>
                            <td width="25%">
                                <a href="{{route('post.show',$ps->slug)}}" target="_blank" rel="noopener noreferrer">{{$ps->title}}</a>
                            </td>
                            <td>
                                <img src="{{asset('images/'.$ps->filename)}}" alt="" height="40" width="40">
                            </td>
                            <td>
                                {{$ps->author}}
                            </td>
                            <td>
                                {{$ps->postCategory->title}}
                            </td>
                            <td>
                                @if ($ps->status == 1)
                                Hoạt động
                                @else
                                tạm ẩn
                                @endif
                            </td>
                            <td>
                                {{$ps->created_at}}
                            </td>
                            <td class="mt-2 navbar-nav text-center">
                                <li class="nav-item dropdown hidden-caret">
                                    <a class="dropdown-toggle profile-pic mt-1" data-toggle="dropdown" href="#" aria-expanded="false">
                                        Thao tác
                                    </a>
                                    <ul class="dropdown-menu dropdown-user animated fadeIn" style="width:10%">
                                        <li>
                                            <div>
                                                <a class="dropdown-item btn-primary text-center btn-link" href="{{route('manage-post.show', $ps->id)}}" data-toggle="tooltip" data-placement="bottom"  title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </div>
                                            <div>
                                                <a class="dropdown-item btn-secondary text-center btn-link" href="{{route('manage-post.edit', $ps->id)}}" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                            </div>
                                            <div>
                                                <form action="{{ route('manage-post.destroy', $ps->id)}}" method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="dropdown-item btn-danger text-center btn-link" data-toggle="tooltip" data-placement="bottom" title="Delete">
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